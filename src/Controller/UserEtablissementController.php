<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Entity\UserEtablissement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserEtablissementController extends AbstractController
{
    #[Route('/like/{id}', name: 'like')]
    public function likeAction(int $id, EntityManagerInterface $entityManager): Response
    {
        $etablissement = $entityManager->getRepository(Etablissement::class)->find($id);

        if (!$etablissement) {

            $this->addFlash('error', 'Établissement introuvable');
            return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Vous devez vous connecter pour aimer un établissement');
            return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        $userEtablissement = $entityManager->getRepository(UserEtablissement::class)->findOneBy([
            'user' => $user,
            'etablissement' => $etablissement
        ]);

        if (!$userEtablissement) {
            $userEtablissement = new UserEtablissement();
            $userEtablissement->setUser($user);
            $userEtablissement->setEtablissement($etablissement);
        }

        $userEtablissement->setLiked(true);
        $userEtablissement->setDisliked(false);

        $entityManager->persist($userEtablissement);
        $entityManager->flush();


        $this->addFlash('success', 'Vous avez aimé cet établissement');
        return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);

    }

    #[Route('/dislike/{id}', name: 'dislike')]
    public function dislikeAction(int $id, EntityManagerInterface $entityManager): Response
    {
        $etablissement = $entityManager->getRepository(Etablissement::class)->find($id);

        if (!$etablissement) {
            $this->addFlash('error', 'Établissement introuvable');
            return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Vous devez vous connecter pour ne pas aimer un établissement.');
            return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);
        }

        $userEtablissement = $entityManager->getRepository(UserEtablissement::class)->findOneBy([
            'user' => $user,
            'etablissement' => $etablissement
        ]);

        if (!$userEtablissement) {
            $userEtablissement = new UserEtablissement();
            $userEtablissement->setUser($user);
            $userEtablissement->setEtablissement($etablissement);
        }

        $userEtablissement->setLiked(false);
        $userEtablissement->setDisliked(true);

        $entityManager->persist($userEtablissement);
        $entityManager->flush();

        $this->addFlash('success', 'Vous n\'avez pas aimé cet établissement.');
        return $this->redirectToRoute('app_etablissement_index', [], Response::HTTP_SEE_OTHER);

    }
}
