<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Reservation; // Add this line
use App\Form\ReservationType; // Add this line
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Paiement; // Add this line
use App\Form\PaiementType;

class PaiementController extends AbstractController
{
    #[Route('/paiement', name: 'app_paiement')]
    public function index(): Response
    {
        return $this->render('paiement/index.html.twig', [
            'controller_name' => 'PaiementController',
        ]);
    }


    #[Route('/addP', name: 'app_paiement_add')]
    public function addPaiement(Request $request): Response
{
    $paiement = new Paiement();
    
    // Retrieve the reservation ID from the request parameters
    $reservationId = $request->query->get('reservationId');
    
    // If reservation ID is provided, set it to the paiement
    if ($reservationId) {
        $idRes = $this->getDoctrine()->getRepository(Reservation::class)->find($reservationId);
        if (!$idRes) {
            throw $this->createNotFoundException('Reservation not found');
        }
        $paiement->setIdRes($idRes);
        
        $eventPrice = $idRes->getEventPrice();
        $nbPlaces = $idRes->getNbPlaces();
        $montant = $eventPrice * $nbPlaces;
        $paiement->setMontant($montant);

    }
    
    $form = $this->createForm(PaiementType::class, $paiement);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($paiement);
        $entityManager->flush();
    
        // Add flash message
        $this->addFlash('success', 'Paiement successfully.');
    
        // Redirect to the list of reservations
        return $this->redirectToRoute('app_reservations');
    }
    
    return $this->render('paiement/add.html.twig', [
        'f' => $form->createView(),
        'reservation' => $idRes
    ]);
    }
    



    #[Route('/paiement/{reservationId}', name: 'app_afficher')]
    public function paiement(int $reservationId): Response
    {
        // Fetch the reservation from the database
        $idRes = $this->getDoctrine()->getRepository(Reservation::class)->find($reservationId);
    
        if (!$idRes) {
            throw $this->createNotFoundException('Reservation not found');
        }
    
        // Fetch payments associated with the reservation
        $paiements = $idRes->getPaiements();
    
        // Render the template to display the list of payments for the reservation
        return $this->render('paiement/afficher.html.twig', [
            'paiements' => $paiements,
        ]);
    }


    #[Route('/paiement/update/{id}', name: 'app_paiement_update')]
public function updatePaiement(Request $request, int $id): Response
{    
    // Fetch the paiement from the database
    $entityManager = $this->getDoctrine()->getManager();
    $paiement = $entityManager->getRepository(Paiement::class)->find($id);

    if (!$paiement) {
        throw $this->createNotFoundException('Paiement not found');
    }

    // Fetch the associated reservation
    $reservation = $paiement->getIdRes();

    // Fetch the reservation ID
    $reservationId = $reservation->getId();

    // Update the associated reservation details
    if ($reservationId) {
        $eventPrice = $reservation->getEventprice();
        $nbPlaces = $reservation->getNbPlaces();
        $montant = $eventPrice * $nbPlaces;

        $paiement->setMontant($montant);
        $paiement->setHeureP(new \DateTime());
    }

    // Create the form for updating the paiement
    $form = $this->createForm(PaiementType::class, $paiement);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Save the updated paiement to the database
        $entityManager->flush();

        $this->addFlash('success', 'Paiement updated successfully.');

        // Redirect back to the update reservation page
        return $this->redirectToRoute('app_reservations');
    }

    // Render the form for updating the paiement
    return $this->render('paiement/add.html.twig', [
        'f' => $form->createView(),
        'reservation' => $reservation
    ]);
}

}
