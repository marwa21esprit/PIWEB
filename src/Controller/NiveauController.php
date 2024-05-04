<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Form\NiveauType;
use App\Repository\NiveauRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Swift_Mailer;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use App\Notification\NouveauCompteNotification;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Dompdf\Dompdf;
use Dompdf\Options;


#[Route('/niveau')]
class NiveauController extends AbstractController

{

    private $notify_creation;
    public function __construct(NouveauCompteNotification $notify_creation)
    {
        $this->notify_creation = $notify_creation;
    }

    #[Route('/', name: 'app_niveau_index', methods: ['GET'])]
    public function index(NiveauRepository $niveauRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $Niv = $niveauRepository->notifyNewNiveau();
        $this->notify_creation->notify($Niv);
    
        // Récupérer les données à paginer depuis le repository
        $donnees = $niveauRepository->findAll();
    
        // Paginer les données
        $niveaux = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            4
        );
    
        // Passer les données paginées à la vue Twig
        return $this->render('niveau/index.html.twig', [
            'niveaux' => $niveaux,
        ]);
    }
    

    #[Route("/back", name: "niveau_back", methods: ['GET'])] 
    public function niveauback(NiveauRepository $niveauRepository): Response
    {
        $niveau = $this->getDoctrine()->getRepository(Niveau::class)->findAll();

        // Passez les apprenants à la vue Twig
        return $this->render('niveau/listniveauback.html.twig', [
            'niveau' => $niveau,
        ]);
    }

    #[Route('/add', name: 'app_niveau_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,MailerInterface $mailer): Response
    {
        $niveau = new Niveau();
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer le fichier téléchargé depuis le formulaire
            $imageFile = $form['image']->getData();
    
            // Générer un nom unique pour le fichier
            $image = md5(uniqid()) . '.' . $imageFile->guessExtension();
    
            // Déplacer le fichier vers le répertoire de destination
            $imageFile->move(
                $this->getParameter('images_directory'),
                $image
            );
    
            // Mettre à jour le nom de fichier dans l'entité Niveau
            $niveau->setImage($image);
    
            // Enregistrer l'entité dans la base de données
            $entityManager->persist($niveau);
            $entityManager->flush();
    
            $this->addFlash('success', 'Level a été ajouté avec succès.');

            

            return $this->redirectToRoute('app_niveau_index');

        }
    
        return $this->render('niveau/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
    #[Route('/statistiques', name: 'app_niveau_statistique')]
    public function stat(NiveauRepository $repository): Response
{
    // Utilisez une méthode du repository pour récupérer les statistiques souhaitées
    $niveauxStats = $repository->statistiquesNiveau();

    // Préparez les données pour le graphique
    $data = [['Prérequis', 'Number of Levels']];
    foreach ($niveauxStats as $stat) {
        $data[] = [$stat['prerequis'], $stat['countPrerequis']];
    }

    // Créez l'objet Barchart et configurez les options
    $barChart = new barchart();
    $barChart->getData()->setArrayToDataTable($data);
    $barChart->getOptions()->getTitleTextStyle()->setColor('#07600');
    $barChart->getOptions()->getTitleTextStyle()->setFontSize(50);

    // Renvoyer la vue Twig avec les données du graphique et les statistiques des niveaux
    return $this->render('niveau/stat.html.twig', [
        'barchart' => $barChart,
        'nbs' => $niveauxStats,
    ]);
}
    
    #[Route('/niveaux', name: 'app_niveau_front', methods: ['GET'])]
    public function front(NiveauRepository $niveauRepository): Response
    {

        return $this->render('niveau/showfront.html.twig', [
            'niveaux' => $niveauRepository->findAll(),
        ]);
       
    }

    #[Route('/{id}', name: 'app_niveau_show', methods: ['GET'])]
public function show(string $id, NiveauRepository $niveauRepository): Response
{
    // Convertir l'ID en entier
    $id = (int) $id;

    $niveau = $niveauRepository->find($id);

    if (!$niveau) {
        throw new NotFoundHttpException('Niveau not found');
    }

    return $this->render('niveau/show.html.twig', [
        'niveau' => $niveau,
    ]);
}

    
   
    
    #[Route('/{id}/edit', name: 'app_niveau_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Niveau $niveau, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_niveau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('niveau/edit.html.twig', [
            'niveau' => $niveau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_niveau_delete', methods: ['POST'])]
    public function delete(Request $request, Niveau $niveau, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$niveau->getId(), $request->request->get('_token'))) {
            $entityManager->remove($niveau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_niveau_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/tri', name: 'app_niveau_tri')]
    function Order(NiveauRepository  $repository,Request $request,PaginatorInterface $paginator){
        $donnees=$repository->Order();
        $niveaux = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            4 // Nombre de résultats par page
        );
        return $this->render("niveau/index.html.twig",
            ['niveaux'=>$niveaux]);
    }
    #[Route('/niveau/search_back1', name: 'app_niveau_search_back1', methods: ["GET"])]
    public function search_back1(Request $request,NiveauRepository $Repository ): Response
    {

        $requestString = $request->get('searchValue');
        $niveaux = $Repository->findTeamwithNumber($requestString);
        $responseArray = [];
        $idx = 0;
        foreach ($niveaux as $niveau) {
            $temp = [
                'id' => $niveau->getId(),
                'name' => $niveau->getName(),
                'prerequis' => $niveau->getPrerequis(),
                'duree' => $niveau->getDuree(),
                'nbformation' => $niveau->getnbformation(),
                'certificat' => $niveau->getCertificat(),
                'description' => $niveau->getDescription(),
                

            ];

            $responseArray[$idx++] = $temp;
        }
        return new JsonResponse($responseArray);
    
    }
    #[Route('/niveau/DOWNtriEQUIPE', name: 'app_niveau_DOWNtriEQUIPE', options: ["expose" => true])]

    public function DOWNtriEQUIPE(Request $request,NiveauRepository $repository): JsonResponse
    {

        $UPorDOWN=$request->get('order');
        $niveaux=$repository->DescNivSearch($UPorDOWN);
        $responseArray = [];
        $idx = 0;
        foreach ($niveaux as $niveau){
            $temp = [
                'id' => $niveau->getId(),
                'name' => $niveau->getName(),
                'prerequis' => $niveau->getPrerequis(),
                'duree' => $niveau->getDuree(),
                'nbformation' => $niveau->getnbformation(),
                'certificat' => $niveau->getCertificat(),
                'description' => $niveau->getDescription(),
            ];

            $responseArray[$idx++] = $temp;

        }
        return new JsonResponse($responseArray);
    }
    #[Route('/niveau/UPtriEQUIPE', name: 'app_niveau_UPtriEQUIPE', options: ["expose" => true])]
    public function UPtriEQUIPE(Request $request,NiveauRepository $repository): JsonResponse
    {
        $UPorDOWN=$request->get('order');
        $Niveaux=$repository->AscNivSearch ($UPorDOWN);
        $responseArray = [];
        $idx = 0;
        foreach ($Niveaux as $niveau){
            $temp = [
                'id' => $niveau->getId(),
                'name' => $niveau->getName(),
                'prerequis' => $niveau->getPrerequis(),
                'duree' => $niveau->getDuree(),
                'nbformation' => $niveau->getnbformation(),
                'certificat' => $niveau->getCertificat(),
                'description' => $niveau->getDescription(),
            ];
            $responseArray[$idx++] = $temp;

        }
        return new JsonResponse($responseArray);
    }
    #[Route('/imprimerNi', name: 'app_niveau_imprimerNi')]
    public function imprimer(NiveauRepository  $repository ,EntityManagerInterface $entityManager)

    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('isRemoteEnabled', true);
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $niveaux = $entityManager
            ->getRepository(Niveau::class)
            ->findAll();

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('niveau/pdf.html.twig', [
            'niveaux' => $niveaux,

        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("Liste  Niveau.pdf", [
            "Attachment" => true

        ]);
    }
}