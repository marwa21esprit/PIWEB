<?php

namespace App\Controller;
use App\Entity\Remiseentry; // Add this line
use App\Form\RemiseType; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class RemiseController extends AbstractController
{
    #[Route('/remise', name: 'app_remise')]
    public function index(): Response
    {
        return $this->render('remise/listR.html.twig', [
            'controller_name' => 'RemiseController',
        ]);
    }


    #[Route('/addR', name: 'app_remise_add')]
    public function addRemise(Request $request): Response
    {
        $remise = new Remiseentry();
        $form = $this->createForm(RemiseType::class, $remise);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Calculate the eventPrice based on the form data
          
            // Persist the reservation to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($remise);
            $entityManager->flush();
    
            // Add flash message
            $this->addFlash('success', 'Remise added successfully.');
            // Redirect to the list of reservations
            return $this->redirectToRoute('app_remises');
        }
    
        return $this->render('remise/add.html.twig', [
            'f' => $form->createView(),
        ]);
    }

   


    #[Route('/listR', name: 'app_remises')]
public function listRemise(): Response
{
    // Fetch reservations from the database
    $remises = $this->getDoctrine()->getRepository(Remiseentry::class)->findAll();

    // Render the template to display the list of reservations
    return $this->render('remise/listR.html.twig', [
        'remises' => $remises,
    ]);
}


#[Route('/remise/delete/{id}', name: 'delete_remise', methods: ['POST'])]

public function deleteRemise(Request $request, int $id): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $remise = $entityManager->getRepository(Remiseentry::class)->find($id);

    if (!$remise) {
        throw $this->createNotFoundException('remise not found');
    }

    // Delete the reservation
    $entityManager->remove($remise);
    $entityManager->flush();

    // Add flash message
    $this->addFlash('success', 'remise deleted successfully.');

    // Redirect to the list of reservations
    return $this->redirectToRoute('app_remises');
}


#[Route('/remise/update/{id}', name: 'edit_remise')]
public function updateRemise(Request $request, int $id): Response
{
    // Fetch the reservation to be updated
    $entityManager = $this->getDoctrine()->getManager();
    $remise = $entityManager->getRepository(Remiseentry::class)->find($id);

    if (!$remise) {
        throw $this->createNotFoundException('remise not found');
    }

    // Create the form for updating the reservation
    $form = $this->createForm(RemiseType::class, $remise);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Save the updated reservation to the database
        $entityManager->flush();

        $this->addFlash('success', 'remise updated successfully.');

        // Redirect to the list of reservations
        return $this->redirectToRoute('app_remises');
    }

    // Render the form for updating the reservation
    return $this->render('remise/update.html.twig', [
        'f' => $form->createView(),
    ]);
}
}
