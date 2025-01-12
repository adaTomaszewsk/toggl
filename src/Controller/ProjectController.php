<?php 

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Column;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends AbstractController
{
    private EntityManagerInterface $entityManager; 
    private UserInterface $currentUser;

    public function __construct(
        EntityManagerInterface $entityManager,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->currentUser = $security->getUser();
    }

    #[Route('/api/projects', name:'api_projects')]
    public function getProjects(): Response
    {
        $projects = $this->entityManager->getRepository(Project::class)->findAll();
 
        return $this->render('components/sidebar_projects_render.html.twig',[
            'projects' => $projects
        ]);
    }

    #[Route('api/create-project', name:'new_project', methods:['POST'])]
    public function createProject(Request $request, EntityManagerInterface $entityManager): JsonResponse {
        $data = json_decode($request->getContent(),true);

        if(!$data || !isset($data['projectName']) || empty(trim($data['projectName']))) {
            return new JsonResponse(['error' => 'Project name is required'], JsonResponse::HTTP_BAD_REQUEST);
        }
        
        $project = new Project();
        $project->setName($data['projectName']);
        $project->setCreatedBy($this->getUser());
        $entityManager->persist($project);

        foreach ($data['columns'] as $columnName) {
            if (empty(trim($columnName))) {
                return new JsonResponse(['error' => 'Column name cannot be empty.'], JsonResponse::HTTP_BAD_REQUEST);
            }
            $column = new Column();
            $column->setName($columnName);
            $column->setProject($project);
    
            $entityManager->persist($column);
        }
        $entityManager->flush();
        
        return new JsonResponse(['message' => 'Project created successfully!'], JsonResponse::HTTP_CREATED);

    }

    #[Route('project/{id}', name: 'project_id')]
    public function projectPage(int $id, EntityManagerInterface $entityManager): Response {
        
        $project =  $this->entityManager->getRepository(Project::class)->findOneBy([
            'id'=> $id
        ]);

        
        return $this->render('project/project_page.html.twig', [
            'project' => $project,
        ]);
    }

}