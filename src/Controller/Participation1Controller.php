<?php

namespace App\Controller;

use App\Entity\Participation1;
use App\Form\Participation1Type;
use App\Repository\Participation1Repository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participation1')]
class Participation1Controller extends AbstractController
{
    #[Route('/', name: 'app_participation1_index', methods: ['GET'])]
    public function index(Participation1Repository $participation1Repository): Response
    {
        return $this->render('participation1/index.html.twig', [
            'participation1s' => $participation1Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_participation1_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $participation1 = new Participation1();
        $form = $this->createForm(Participation1Type::class, $participation1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($participation1);
            $entityManager->flush();

            return $this->redirectToRoute('app_participation1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participation1/new.html.twig', [
            'participation1' => $participation1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participation1_show', methods: ['GET'])]
    public function show(Participation1 $participation1): Response
    {
        return $this->render('participation1/show.html.twig', [
            'participation1' => $participation1,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_participation1_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participation1 $participation1, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Participation1Type::class, $participation1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_participation1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participation1/edit.html.twig', [
            'participation1' => $participation1,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participation1_delete', methods: ['POST'])]
    public function delete(Request $request, Participation1 $participation1, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation1->getId(), $request->request->get('_token'))) {
            $entityManager->remove($participation1);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_participation1_index', [], Response::HTTP_SEE_OTHER);
    }
}