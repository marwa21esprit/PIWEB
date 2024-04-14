<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Home extends AbstractController
{
<<<<<<< HEAD
    #[Route('/', name: 'index')]
=======
    #[Route('/', name: 'app_index')]
>>>>>>> main
    public function index(): Response
    {
        return $this->render('front/home.html.twig');
    }
<<<<<<< HEAD
=======
    #[Route('/admin', name: 'app_index_admin')]
    public function indexAdmin(): Response
    {
        return $this->render('back/home.html.twig');
    }
>>>>>>> main


    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig');
    }

    
}
