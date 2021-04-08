<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class ConceptController extends AbstractController
{
    #[Route('/concept', name: 'concept')]
    
    public function index(Request $request, MailerInterface $mailer): Response 
    {

        $formulaire = $this->createForm(ContactType::class);
        
        //Insertion des données de $_POST dans ce formulaire
        $formulaire->handleRequest($request);

             if ($formulaire->isSubmitted() && $formulaire->isValid()) {

                $data = $formulaire->getData();
                 /* dd($data); */
                 
                $email = (new Email())
                        ->from($data['email'])
                        ->to('contact@findmyart.com')
                        ->subject('Formulaire de contact')
                        ->text($this->renderView('mails/concept.txt.twig'))
                        ->html($this->renderView('mails/concept.html.twig',[ 
                                'email' => $data 
                        ]));

                $mailer->send($email);
                /* dump($formulaire->getData()); */

                /* die('mail envoyé'); */
                
                 $this->addFlash('success', 'Votre commentaire a bien été ajouté !');

                 return $this->redirectToRoute('concept');
             }

        return $this->render('concept/index.html.twig', [
            'controller_name' => 'ConceptController',
            'contact_form' => $formulaire->createView(),
        ]);
    }
}
