<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConceptController extends AbstractController
{
    #[Route('/concept', name: 'concept')]
    public function index(): Response
    {

        $formulaire = $this->createForm(ContactType::class);
        
        // Insertion des données de $_POST dans ce formulaire
        // $formulaire->handleRequest();

        //     if ($formulaire->isSubmitted() && $formulaire->isValid()) {
        //         $formulaire->getData();
                
        //         $this->addFlash('success', 'Votre commentaire a bien été ajouté !');

        //         return $this->redirectToRoute('concept');
        //     }

        return $this->render('concept/index.html.twig', [
            'controller_name' => 'ConceptController',
            'contact_form' => $formulaire->createView(),
        ]);
    }
}
