<?php

namespace App\Controller;

<<<<<<< HEAD
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Entity\Paiement;
use App\Form\PaiementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationRepository; 

class Dashboard extends AbstractController
{
    #[Route('/back', name: 'Dashboard')]
    public function index(ReservationRepository $reservationRepository): Response
    {
        $totalReservations = $this->getDoctrine()->getRepository(Reservation::class)->getTotalReservations();
        $totalAmount = $this->getDoctrine()->getRepository(Paiement::class)->getTotalAmount();
        
        return $this->render('back/Dashboard.html.twig', [
            'totalReservations' => $totalReservations,
            'totalAmount' => $totalAmount,
        ]);
    }

    
}

=======
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
>>>>>>> main
