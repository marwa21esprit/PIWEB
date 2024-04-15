<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Dashboard extends AbstractController
{
    #[Route('/D', name: 'Dashboard')]
    public function index(): Response
    {
        return $this->render('back/Dashboard.html.twig');
    }




    
}
