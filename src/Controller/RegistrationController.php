<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;


class RegistrationController extends AbstractController {

    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    
    #[Route('/registration', name:'app_registration')]
    public function register(UserPasswordHasherInterface $passwordHasher, Request $request ): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        dump($form);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword(),
            );
            $user->setPassword($hashedPassword);

            $this->em->persist($user);
            $this->em->flush();

            return $this->redirectToRoute('app_login');
        }
        return $this->render('registration/index.html.twig', [
            'form' => $form,
        ]);
    
    }
}