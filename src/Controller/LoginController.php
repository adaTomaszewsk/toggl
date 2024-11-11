<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController extends AbstractController
{
    #[Route("/login", name:"app_login")]
    public function login(AuthenticationUtils $authenticationUtils): Response
    { 
        $error = $authenticationUtils->getLastAuthenticationError();
        $email = $authenticationUtils->getLastUsername();
        var_dump($email);
                                  
        return $this->render('login/index.html.twig', [
            'error' => $error,
            'last_username' => $email,
        ]);
    }
}