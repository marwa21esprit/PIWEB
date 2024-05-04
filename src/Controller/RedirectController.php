<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class RedirectController extends AbstractController
{
  
    #[Route('/home', name: 'home')]
    public function home()
    {
        return $this->render('frontend/homefront.html.twig');
    }

    
     
     #[Route('/homeback', name: 'homeback')]
    public function homeback()
    {
        return $this->render('backend/homeback.html.twig');
    }

   
    #[Route('/about', name: 'about')]
    public function about()
    {
        return $this->render('frontend/about.html.twig', [
            
        ]);
    }
}
