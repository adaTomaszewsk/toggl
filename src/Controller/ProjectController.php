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


}