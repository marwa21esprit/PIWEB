<?php

namespace App\Controller;

use App\Entity\Formationn;
use App\Form\FormationnType;
use App\Repository\FormationnRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class FormationController extends AbstractController
{
    #[Route('/', name: 'app_formation_index', methods: ['GET'])]
    public function index(FormationnRepository $formationnRepository): Response
    {
        return $this->render('back/formation/index.html.twig', [
            'formationns' => $formationnRepository->findAll(),
        ]);
    }

    #[Route('/front', name: 'app_formation_index_front', methods: ['GET'])]
    public function indexFront(FormationnRepository $formationnRepository): Response
    {
        return $this->render('front/formation/index.html.twig', [
            'formationns' => $formationnRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formation_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $formation = new Formationn();
        $form = $this->createForm(FormationnType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('back/formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('front/new', name: 'app_formation_new_front', methods: ['GET', 'POST'])]
    public function newfront(Request $request): Response
    {
        $formation = new Formationn();
        $form = $this->createForm(FormationnType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);
    }

    

    #[Route('/{id_formation}', name: 'app_formation_show', methods: ['GET'])]
    public function show(Formationn $formationn): Response
    {
        return $this->render('back/formation/show.html.twig', [
            'formationn' => $formationn,
        ]);
    }

    #[Route('/{id_formation}/edit', name: 'app_formation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formationn $formationn, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormationnType::class, $formationn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/formation/edit.html.twig', [
            'formationn' => $formationn,
            'form' => $form,
        ]);
    }

    #[Route('/{id_formation}/edit_front', name: 'app_formation_edit_front', methods: ['GET', 'POST'])]
    public function editfront(Request $request, Formationn $formationn, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormationnType::class, $formationn);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('front/formation/edit.html.twig', [
            'formationn' => $formationn,
            'form' => $form,
        ]);
    }
    
    

    #[Route('/{id_formation}', name: 'app_formation_delete', methods: ['POST'])]
    public function delete(Request $request, Formationn $formationn, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formationn->getId_formation(), $request->request->get('_token'))) {
            $entityManager->remove($formationn);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
    }
}
