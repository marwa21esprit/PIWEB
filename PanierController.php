<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Panier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event; // Import the Event entity if not already imported

class PanierController extends AbstractController
{

    #[Route('/cart/add/{id}', name: 'cart_add')]
    public function addToCart(Request $request, Event $event): Response
    {
        // Get the panier from the database or create a new one
        $panier = $this->getDoctrine()->getRepository(Panier::class)->findOneBy([]);
    
        // If panier doesn't exist, create a new one
        if (!$panier) {
            $panier = new Panier();
        }
    
        // Add the event to the panier
        $panier->addEvent($event);
    
        // Persist the changes to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($panier);
        $entityManager->flush();
    
        // Redirect to the cart page
        return $this->redirectToRoute('show_panier');
    }
    
    #[Route('/cart', name: 'show_panier')]
    public function showCart(Request $request): Response
    {
        // Get the panier from the database or create a new one
        $panier = $this->getDoctrine()->getRepository(Panier::class)->findOneBy([]);
    
        // If panier doesn't exist, create a new one
        if (!$panier) {
            $panier = new Panier();
        }
    
        // Retrieve the events from the panier
        $events = $panier->getEvents();
    
        return $this->render('panier/panier.html.twig', [
            'panier' => $panier,
            'events' => $events,
        ]);
    }
}
