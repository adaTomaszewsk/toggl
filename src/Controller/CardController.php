<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Card;
use App\Entity\Column;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\SecurityBundle\Security;


class CardController extends AbstractController {
    private EntityManagerInterface $entityManager; 
    private UserInterface $currentUser;

    public function __construct(
        EntityManagerInterface $entityManager,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->currentUser = $security->getUser();
    }


    #[Route('api/create-card', name:'create_card', methods:['POST'])]
    public function createCard(Request $request, EntityManagerInterface $entityManager): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['title']) || empty(trim($data['title']))) {
            return new JsonResponse(['error' => 'Card title is required'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $column = $this->entityManager->getRepository(Column::class)->find($data['column_id']);
        if (!$column instanceof Column) {
            throw new RuntimeException('No column found');
        }

        $card = new Card();
        $card->setTitle($data['title']);
        $card->setDescription('');
        $card->setColumn($column);
        $card->setCreatedAt(new \DateTime());
        $entityManager->persist($card);
        $entityManager->flush();
        return new JsonResponse(['message' => 'Project created successfully!'], JsonResponse::HTTP_CREATED);
    }


}