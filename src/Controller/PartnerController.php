<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/partner')]
class PartnerController extends AbstractController
{

    /*#[Route('/partner', name: 'app_partner')]
    public function index(): Response
    {
        return $this->render('partner/index.html.twig', [
            'controller_name' => 'PartnerController',
        ]);
    }*/



    #[Route('/add', name: 'app_partner_add')]//ajout avec un formulaire
    public function newPartner(EntityManagerInterface $em, Request $req): Response
    {
        $partner = new Partner();
        $form=$this->createForm(PartnerType::class,$partner);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) { 
            // Vérifie si le formulaire a été soumis et est valide

            // Récupérer le fichier téléchargé à partir du formulaire
            $imageFile = $form->get('image')->getData();

            // Vérifier si un fichier a été téléchargé
            if ($imageFile) {
                // Générer un nom de fichier unique
                $fileName = md5(uniqid()).'.'.$imageFile->guessExtension();

                // Déplacer le fichier téléchargé vers le répertoire de destination
                $imageFile->move(
                    $this->getParameter('upload_directory'), // Répertoire de destination configuré dans services.yaml ou parameters.yaml
                    $fileName
                );

                // Définir le nom du fichier dans l'entité Partner
                $partner->setImage($fileName);
            }

            // Enregistrer l'entité Partner en base de données
            $em->persist($partner);
            $em->flush();

            // Rediriger vers une autre page après l'ajout d'un événement
            return $this->redirectToRoute("app_partner");
        }
        return $this->render('partner/add.html.twig', [
            'title' => 'Add Partner',
            'formPartner' => $form->createView()
        ]);
    }

    #[Route('/admin', name: 'app_partner')]
    public function Partner(PartnerRepository $pR): Response
    {
        $partnersBD=$pR->findAll();
        return $this->render('partner/listPartnerBack.html.twig', [
            'controller_name' => 'PartnerController',
            'partners'=>$partnersBD,
        ]);
    }

    #[Route('/', name: 'app_partner_front')]
    public function PartnerFront(PartnerRepository $pR): Response
    {
        $partnersBD=$pR->findAll();
        return $this->render('partner/listPartnerFront.html.twig', [
            'controller_name' => 'PartnerController',
            'partners'=>$partnersBD,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_partner_delete')]
    public function delete($id, EntityManagerInterface $entityManagerInterface, PartnerRepository $partnerRepository)
    {
        $partner= $partnerRepository->find($id);
        if (!$partner) {
            throw $this->createNotFoundException('Partner not found');
        }
        $entityManagerInterface->remove($partner);
        $entityManagerInterface->flush();
        return $this->redirectToRoute('app_partner');
    }

    #[Route('/update/{id}', name: 'app_partner_update')]
    public function fedit(Request $request,$id, EntityManagerInterface $entityManagerInterface, PartnerRepository $partnerRepository)
    {
        $partner= $partnerRepository->find($id);
        $form=$this->createForm(PartnerType::class,$partner);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $file = $form->get('image')->getData();
            if($file)
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('upload_directory'),
                        $fileName
                    );
                } catch (FileException $e){

                }
                $partner->setImage($fileName);
            }
            $entityManagerInterface->persist($partner);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('app_partner');
        }
         return $this->renderForm('partner/add.html.twig',[
            'formPartner'=>$form,
            'title'=>'Edit Partner']);   
    }
    #[Route('/event/{id}', name: 'show_partners_by_event')]
    public function showPartnersByEvent(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Récupérer l'événement par son identifiant
        $event = $entityManager->getRepository(Event::class)->find($id);

        if (!$event) {
            throw $this->createNotFoundException('Event not found');
        }

        // Récupérer les partenaires associés à l'événement en utilisant son identifiant
        $partners = $entityManager->getRepository(Partner::class)->findBy(['idEvent' => $id]);

        // Rendre le template Twig et passer l'événement et ses partenaires associés
        return $this->render('partner/show_partners_by_event.html.twig', [
            'event' => $event,
            'partners' => $partners,
        ]);
    }

}
