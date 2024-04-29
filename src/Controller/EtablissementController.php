<?php

namespace App\Controller;

use App\Entity\Certificat;
use App\Entity\Etablissement;
use App\Entity\UserEtablissement;
use App\Form\EtablissementType;
use App\Repository\EtablissementRepository;
use App\Repository\UserEtablissementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

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

        // Retrieve associated UserEtablissement entities
        $userEtablissementRepository = $entityManager->getRepository(UserEtablissement::class);
        $userEtablissements = $userEtablissementRepository->findBy(['etablissement' => $etablissement]);

        // Remove associated UserEtablissement entities
        foreach ($userEtablissements as $userEtablissement) {
            $entityManager->remove($userEtablissement);
        }

        // Flush the changes before deleting the Etablissement
        $entityManager->flush();

        // Delete the Etablissement
        $entityManager->remove($etablissement);
        $entityManager->flush();

        return $this->redirectToRoute('app_etablissement_index_admin', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/r/search_etablissement', name: 'search_etablissement', methods: ['GET'])]
    public function searchEtablissement(
        Request $request,
        SerializerInterface $serializer,
        EtablissementRepository $etablissementRepository,
        UserEtablissementRepository $userEtablissementRepository
    ): Response {
        $searchValue = $request->query->get('searchValue');
        $orderId = $request->query->get('orderid');

        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        $qb->select('e')
            ->from(Etablissement::class, 'e')
            ->where($qb->expr()->like('e.nomEtablissement', ':value'))
            ->orWhere($qb->expr()->like('e.adresseEtablissement', ':value'))
            ->setParameter('value', '%' . $searchValue . '%');

        if ($orderId === 'DESC') {
            $qb->orderBy('e.ID_Etablissement', 'DESC');
        } else {
            $qb->orderBy('e.ID_Etablissement', 'ASC');
        }

        $query = $qb->getQuery();
        $etablissements = $query->getResult();

        // Calculate likes and dislikes for each establishment
        foreach ($etablissements as $etablissement) {
            $likes = 0;
            $dislikes = 0;

            foreach ($etablissement->getUserEtablissements() as $userEtablissement) {
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

        // Serialize the data into JSON format
        $jsonData = $serializer->serialize($etablissements, 'json', [
            'groups' => ['etablissement:read']
        ]);
        return new JsonResponse($jsonData);


    }



}
