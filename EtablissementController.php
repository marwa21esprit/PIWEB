<?php

namespace App\Controller;

use App\Entity\Certificat;
use App\Entity\Etablissement;
use App\Form\EtablissementType;
use App\Repository\EtablissementRepository;
use App\Repository\UserEtablissementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etablissement')]
class EtablissementController extends AbstractController
{

    #[Route('/', name: 'app_etablissement_index')]

    public function showEtablissement(
        EtablissementRepository $etablissementRepository,
        UserEtablissementRepository $userEtablissementRepository
    ): Response {
        $etablissements = $etablissementRepository->findAll();

        foreach ($etablissements as $etablissement) {
            $userEtablissements = $userEtablissementRepository->findBy(['etablissement' => $etablissement]);

            $likes = 0;
            $dislikes = 0;

            foreach ($userEtablissements as $userEtablissement) {
                if ($userEtablissement->getLiked()) {
                    $likes++;
                }
                if ($userEtablissement->getDisliked()) {
                    $dislikes++;
                }
            }

            $etablissement->setLikes($likes);
            $etablissement->setDislikes($dislikes);
        }

        return $this->render('front/etablissement/index.html.twig', [
            'etablissements' => $etablissements,
        ]);
    }


    #[Route('/admin', name: 'app_etablissement_index_admin')]
    public function showEtablissementAdmin(EtablissementRepository $etablissementRepository, UserEtablissementRepository $userEtablissementRepository): Response
    {
        $etablissements = $etablissementRepository->findAll();

        foreach ($etablissements as $etablissement) {
            $userEtablissements = $userEtablissementRepository->findBy(['etablissement' => $etablissement]);

            $likes = 0;
            $dislikes = 0;

            foreach ($userEtablissements as $userEtablissement) {
                if ($userEtablissement->getLiked()) {
                    $likes++;
                }
                if ($userEtablissement->getDisliked()) {
                    $dislikes++;
                }
            }

            $etablissement->setLikes($likes);
            $etablissement->setDislikes($dislikes);
        }

        return $this->render('back/etablissement/index.html.twig', [
            'etablissements' => $etablissements, // Correction ici
        ]);
    }


    public function showEtablissement(EtablissementRepository $aR): Response
    {
        $etablissBD=$aR->findAll();
        return $this->render('front/etablissement/index.html.twig', [
            'etablissements'=>$etablissBD,
        ]);
    }
    #[Route('/admin', name: 'app_etablissement_index_admin')]
    public function showEtablissementAdmin(EtablissementRepository $aR): Response
    {
        $etablissBD=$aR->findAll();
        return $this->render('back/etablissement/index.html.twig', [
            'etablissements'=>$etablissBD,
        ]);
    }

    #[Route('/new', name: 'app_etablissement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etablissement = new Etablissement();
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imgEtablissement')->getData();
            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {

                }
                $etablissement->setImgEtablissement($fileName);
            } else {
                $etablissement->setImgEtablissement("NoImage.png");
            }
            $entityManager->persist($etablissement);
            $entityManager->flush();

            return $this->redirectToRoute('app_etablissement_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/etablissement/new.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form,
        ]);
    }

    #[Route('/show/{id}', name: 'app_etablissement_show', methods: ['GET'])]
    public function show(Etablissement $etablissement): Response
    {
        return $this->render('back/etablissement/show.html.twig', [
            'etablissement' => $etablissement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etablissement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etablissement $etablissement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('imgEtablissement')->getData(); // Access uploaded file correctly
            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    // Handle file upload error
                }
                $etablissement->setImgEtablissement($fileName);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_etablissement_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/etablissement/edit.html.twig', [
            'etablissement' => $etablissement,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_etablissement_delete', methods: ['POST'])]
    public function deleteEtablissement(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $etablissementRepository = $entityManager->getRepository(Etablissement::class);
        $etablissement = $etablissementRepository->find($id);

        if (!$etablissement) {
            throw $this->createNotFoundException('Etablissement not found');
        }

        $certificatRepository = $entityManager->getRepository(Certificat::class);
        $certificats = $certificatRepository->findBy(['idEtablissement' => $etablissement]);

        foreach ($certificats as $certificat) {
            $entityManager->remove($certificat);
        }

        $entityManager->remove($etablissement);
        $entityManager->flush();

        return $this->redirectToRoute('app_etablissement_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}
