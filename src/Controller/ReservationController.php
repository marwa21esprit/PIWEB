<?php

namespace App\Controller;

use App\Entity\Reservation; // Add this line
use App\Entity\Event; // Add this line
use App\Form\ReservationType; // Add this line
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Paiement; // Add this line
use App\Form\PaiementType;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }


    #[Route('/add/{eventId}', name: 'app_reservation_add')]
public function addReservation(Request $request, int $eventId): Response
{        
         $event = $this->getDoctrine()->getRepository(Event::class)->find($eventId);
        if (!$event) {
             throw $this->createNotFoundException('Event not found');
        }
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Calculate the eventPrice based on the form data
            $nbPlaces = $reservation->getNbPlaces();
            $eventPrice = $event->getPrix();
            $eventName = $event->getNameevent();
            $image = $event->getImage();

            // Set the eventPrice to the calculated value
            $reservation->setEventPrice($eventPrice);
            $reservation->setIdEvent($event);
            $reservation->setNamee($eventName);
            $reservation->setImagesrc($image);

            // Persist the reservation to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();
    
            // Add flash message
            $this->addFlash('success', 'Reservation added successfully.');
            // Redirect to the list of reservations
            return $this->redirectToRoute('app_paiement_add', ['reservationId' => $reservation->getId()]);
        }
    
        return $this->render('reservation/add.html.twig', [
            'f' => $form->createView(),
            'event' => $event,
        ]);
    }

   


    #[Route('/list', name: 'app_reservations')]
public function listReservations(): Response
{
    // Fetch reservations from the database
    $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();

    // Render the template to display the list of reservations
    return $this->render('reservation/list.html.twig', [
        'reservations' => $reservations,
    ]);
}

#[Route('/listb', name: 'back')]
public function listReservation(): Response
{
    // Fetch reservations from the database
    $reservations = $this->getDoctrine()->getRepository(Reservation::class)->findAll();

    // Render the template to display the list of reservations
    return $this->render('reservation/listback.html.twig', [
        'reservations' => $reservations,
    ]);
}


#[Route('/reservation/delete/{id}', name: 'app_reservation_delete', methods: ['POST'])]
public function deleteReservation(Request $request, int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $reservation = $entityManager->getRepository(Reservation::class)->find($id);

    if (!$reservation) {
        throw $this->createNotFoundException('Reservation not found');
    }

    // Delete the reservation
    $entityManager->remove($reservation);
    $entityManager->flush();

    // Add flash message
    $this->addFlash('success', 'Reservation deleted successfully.');

    // Redirect to the list of reservations
    return $this->redirectToRoute('app_reservations');
}

#[Route('/reservation/update/{id}', name: 'app_reservation_update')]
public function updateReservation(Request $request, int $id): Response
{
    // Fetch the reservation to be updated
    $entityManager = $this->getDoctrine()->getManager();
    $reservation = $entityManager->getRepository(Reservation::class)->find($id);

    if (!$reservation) {
        throw $this->createNotFoundException('Reservation not found');
    }

    // Create the form for updating the reservation
    $form = $this->createForm(ReservationType::class, $reservation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        // Save the updated reservation to the database
        $entityManager->flush();

        // Fetch the associated paiement
        $paiement = $entityManager->getRepository(Paiement::class)->findOneBy(['idRes' =>$reservation->getId()]);

        if ($paiement) {
            // Calculate montantT based on eventPrice and updated nbPlaces
            $eventPrice = $reservation->getEventprice();
            $updatedNbPlaces = $reservation->getNbPlaces();
            $montantT = $eventPrice * $updatedNbPlaces;
            $paiement->setMontant($montantT);

            // Update the paiement's montantT in the database
            $entityManager->flush();
        }else{
            $paiement = new Paiement();
            $paiement->setIdRes($reservation);

            $eventPrice = $reservation->getEventPrice();
            $montant = $eventPrice * $reservation->getNbPlaces();
            $paiement->setMontant($montant);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paiement);
            $entityManager->flush();


        }

        $this->addFlash('success', 'Reservation updated successfully.');

        // Redirect to the list of reservations
        return $this->redirectToRoute('app_paiement_update', ['id' => $paiement->getId()]);
    }

    // Render the form for updating the reservation
    return $this->render('reservation/update.html.twig', [
        'f' => $form->createView(),
    ]);
}


#[Route('/search', name:'search_reservations', methods:['GET'])]
public function search(Request $request): Response
{
    $query = $request->query->get('query');

    // Perform the search query using your repository or ORM
    $entityManager = $this->getDoctrine()->getManager();
    $reservations = $entityManager->getRepository(Reservation::class)->findBySearchQuery($query);

    // Render the template with the search results
    return $this->render('reservation/listback.html.twig', [
        'reservations' => $reservations,
    ]);
}

}
