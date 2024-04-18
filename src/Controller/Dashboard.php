<?php

namespace App\Controller;

use App\Entity\Tuteur;
use App\Entity\Formationn;
use App\Repository\TuteurRepository;
use App\Repository\FormationnRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Dashboard extends AbstractController
{
    #[Route('/back', name: 'Dashboard')]
    public function index(FormationnRepository $formationnRepository): Response
    {
       
        return $this->render('back/Dashboard.html.twig');
            
    }

   
}

