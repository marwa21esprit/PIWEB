<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event')]
    public function showEvent(EventRepository $eR): Response
    {
        $eventsBD=$eR->findAll();
        return $this->render('event/index.html.twig', [
            'events'=>$eventsBD,
        ]);
    }


    #[Route('/admin', name: 'app_event_back')]
    public function EventFront(EventRepository $eR,PartnerRepository $pR): Response
    {
        $partiesBD=$pR->findAll();
        $eventsBD=$eR->findAll();
        return $this->render('event/listEventBack.html.twig', [
            'events'=>$eventsBD,
            'partners'=>$partiesBD,
        ]);
    }
    #[Route('/add', name: 'app_event_add')]
    public function newEvent(EntityManagerInterface $em, Request $req): Response
    {
        $event = new Event();

        $form = $this->createForm(EventType::class, $event);
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

                // Définir le nom du fichier dans l'entité Event
                $event->setImage($fileName);
            }
            else
            {
                $event->setImage('');
            }

            // Enregistrer l'entité Event en base de données
            $em->persist($event);
            $em->flush();

            // Rediriger vers une autre page après l'ajout d'un événement
            return $this->redirectToRoute("app_event_back");
        }

        // Rendre le formulaire dans le template twig approprié
        return $this->render('event/add.html.twig', [
            'title' => 'Add Event',
            'formEvent' => $form->createView()
        ]);
    }


    #[Route('/partner/{id}', name: 'show_events_by_partner')]
    public function EventPartieFront(EventRepository $eR,PartnerRepository $pR,$id): Response
    {
        $eventsBD=$eR->findBy([
            'idpartnerce' => $id
        ]);
        return $this->render('event/eventsParnter.html.twig', [
            'events'=>$eventsBD,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_event_delete')]
    public function delete($id, EntityManagerInterface $entityManagerInterface, EventRepository $eventRepository)
    {
        $event= $eventRepository->find($id);
        $entityManagerInterface->remove($event);
        $entityManagerInterface->flush();
        return $this->redirectToRoute('app_event_back');
    }

    #[Route('/update/{id}', name: 'app_event_update')]
    public function fedit(Request $request,$id, EntityManagerInterface $entityManagerInterface, EventRepository $eventRepository)
    {
        $event= $eventRepository->find($id);
        $form=$this->createForm(EventType::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
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
                $event->setImage($fileName);
            }
            $entityManagerInterface->persist($event);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('app_event_back');
        }
         return $this->renderForm('event/add.html.twig',[
            'formEvent'=>$form,
            'title'=>'Edit Event']);   
    }
}
