<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Entity\Paiement;
use App\Form\PaiementType;
use App\Repository\PaiementRepository;
use App\Repository\ReservationRepository;

class Home extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('front/home.html.twig');
    }


    
    #[Route('/admin', name: 'app_index_admin')]
    public function indexAdmin(UserRepository $userRepository, ReservationRepository $reservationRepository): Response
{
    // Fetch the number of reservations for each event
    $eventReservations = $reservationRepository->getEventReservationsCount();

    dump($eventReservations); // Debug statement

    // Format data for the chart
    $chartData = [
        'labels' => [],
        'datasets' => [
            [
                'data' => [],
                'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56'], // Add more colors as needed
            ],
        ],
    ];

    // Populate the data arrays
    foreach ($eventReservations as $eventReservation) {
        $chartData['labels'][] = $eventReservation['eventName'];
        $chartData['datasets'][0]['data'][] = $eventReservation['totalPlaces'];
    }

    dump($chartData); // Debug statement

    // Other data for your admin dashboard
    $totalReservations = $this->getDoctrine()->getRepository(Reservation::class)->getTotalReservations();
    $totalAmount = $this->getDoctrine()->getRepository(Paiement::class)->getTotalAmount();
    $usersConnected = $userRepository->createQueryBuilder('u')
        ->where('u.lastlogin IS NOT NULL')
        ->orderBy('u.lastlogin', 'DESC')
        ->getQuery()
        ->getResult();

    return $this->render('back/home.html.twig', [
        'totalReservations' => $totalReservations,
        'totalAmount' => $totalAmount,
        'usersConnected' => $usersConnected,
        'chartData' => $chartData,
    ]);
}

    

}
