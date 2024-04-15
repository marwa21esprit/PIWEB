<?php

namespace App\Controller;

use App\Entity\Event; // Add this line
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event')]
    public function showEvent(): Response
    {
        $eventsBD = $this->getDoctrine()->getRepository(Event::class)->findAll();

        return $this->render('event/index.html.twig', [
            'events'=>$eventsBD,
        ]);
    }
    #comment

}
