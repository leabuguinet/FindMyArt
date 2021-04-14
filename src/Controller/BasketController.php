<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'basket')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        
        // Le panier affiche les objets
        $panier = $session->get('basket');
        dump($panier);

        // Requte pour récupérer tous les pièces en fonction des ids
        // SELECT * FROM pieces WHERE id IN (12, 5, 9)


        return $this->render('basket/index.html.twig', [
            'controller_name' => 'BasketController',
            // ....
        ]);
    }

    #[Route('/basket/add/{id}', name: 'add_basket')]
    public function add(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        // Récupère la piece avec l'id: si l'objet n'existe pas je l'ajoute pas au panier

        $session = $request->getSession();
        // Récupère le panier
        $panier = $session->get('basket', []);
        $panier[] = $id;

        dd($panier);

        $session->set('basket', $panier);

        /*
        [12, 5, 9]
        */

        // Redirection sur la piece
    }
}
