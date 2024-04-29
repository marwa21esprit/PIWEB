<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Form\FeedbackType;
use App\Repository\FeedbackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/feed/back')]
class FeedBackController extends AbstractController
{
    #[Route('/', name: 'app_feed_back_index', methods: ['GET'])]
    public function index(FeedbackRepository $feedbackRepository): Response
    {
        return $this->render('feed_back/index.html.twig', [
            'feedback' => $feedbackRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_feed_back_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($feedback);
            $entityManager->flush();

            return $this->redirectToRoute('app_feed_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('feed_back/add.html.twig', [
            'feedback' => $feedback,
            'form' => $form,
        ]);
    }
    #[Route('/avis', name: 'app_feedback_front', methods: ['GET'])]
    public function front(FeedbackRepository $feedbackRepository): Response
    {

        return $this->render('feed_back/showfront.html.twig', [
            'feedback' => $feedbackRepository->findAll(),
        ]);
       
    }
    #[Route('/{id}', name: 'app_feed_back_show', methods: ['GET'])]
    public function show(Feedback $feedback): Response
    {
        return $this->render('feed_back/show.html.twig', [
            'feedback' => $feedback,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_feed_back_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Feedback $feedback, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_feed_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('feed_back/edit.html.twig', [
            'feedback' => $feedback,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_feed_back_delete', methods: ['POST'])]
    public function delete(Request $request, Feedback $feedback, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$feedback->getId(), $request->request->get('_token'))) {
            $entityManager->remove($feedback);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_feed_back_index', [], Response::HTTP_SEE_OTHER);
    }
}
