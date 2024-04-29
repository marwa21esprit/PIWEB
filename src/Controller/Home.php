<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Home extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('front/home.html.twig');
    }
    #[Route('/admin', name: 'app_index_admin')]
    public function indexAdmin(UserRepository $userRepository): Response
    {
        $usersConnected = $userRepository->createQueryBuilder('u')
            ->where('u.lastlogin IS NOT NULL')
            ->orderBy('u.lastlogin', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('back/home.html.twig',[
            'usersConnected'=>$usersConnected,
        ]);
    }


    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('front/contact.html.twig');
    }

}
