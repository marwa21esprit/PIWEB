<?php

namespace App\Controller;

use App\Entity\Certificat;
use App\Entity\Etablissement;
use App\Form\CertificatType;
use App\Repository\CertificatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/certificat')]
class CertificatController extends AbstractController
{
    #[Route('/etablissement/{id}', name: 'show_certificats_by_etablissement')]
    public function showCertificatsByEtablissement(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $etablissement = $entityManager->getRepository(Etablissement::class)->find($id);

        if (!$etablissement) {
            throw $this->createNotFoundException('Etablissement not found');
        }

        // Fetch Certificat entities associated with the given establishment ID
        $certificats = $entityManager->getRepository(Certificat::class)->findBy(['idEtablissement' => $etablissement]);

        // Render the Twig template and pass the establishment and its associated certificates
        return $this->render('front/certificat/show_certificats_by_etablissement.html.twig', [
            'etablissement' => $etablissement,
            'certificats' => $certificats,
        ]);
    }

    #[Route('/', name: 'app_certificat_index', methods: ['GET'])]
    public function index(CertificatRepository $certificatRepository): Response
    {
        return $this->render('front/certificat/index.html.twig', [
            'certificats' => $certificatRepository->findAll(),
        ]);
    }
    #[Route('/admin', name: 'app_certificat_index_admin', methods: ['GET'])]
    public function indexAdmin(CertificatRepository $certificatRepository): Response
    {
        return $this->render('back/certificat/index.html.twig', [
            'certificats' => $certificatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_certificat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $certificat = new Certificat();
        $form = $this->createForm(CertificatType::class, $certificat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($certificat);
            $entityManager->flush();

            return $this->redirectToRoute('app_certificat_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/certificat/new.html.twig', [
            'certificat' => $certificat,
            'form' => $form,
        ]);
    }

    #[Route('/{idCertificat}', name: 'app_certificat_show', methods: ['GET'])]
    public function show(Certificat $certificat): Response
    {
        return $this->render('back/certificat/show.html.twig', [
            'certificat' => $certificat,
        ]);
    }

    #[Route('/{idCertificat}/edit', name: 'app_certificat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Certificat $certificat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CertificatType::class, $certificat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_certificat_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/certificat/edit.html.twig', [
            'certificat' => $certificat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_certificat_delete', methods: ['POST'])]
    public function delete(Request $request, Certificat $certificat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$certificat->getIdCertificat(), $request->request->get('_token'))) {
            $entityManager->remove($certificat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_certificat_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}
