<?php

namespace App\Controller;

use App\Entity\Piece;
use App\Entity\Renting;
use App\Entity\RentingDetail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'basket')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();

        // Le panier affiche les objets
        $panier = $session->get('basket');
        dump($panier);

        // Requte pour récupérer tous les pièces en fonction des ids
        // SELECT * FROM pieces WHERE id IN (12, 5, 9)
        $pieces = $entityManager->getRepository(Piece::class)->findByIds($panier);
        //$imagePath = $storageInterface->resolvePath($piece, 'imageFile');

        return $this->render('basket/index.html.twig', [
            'panier' => $pieces
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


        $session->set('basket', $panier);

        /*
        [12, 5, 9]
        */

        // Redirection sur la piece
        return $this->redirectToRoute('basket');
    }
    #[Route('/basket/renting', name: 'add_renting')]
    public function rentingAdd(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $request->getSession();
        $panier = $session->get('basket');
        $pieces = $entityManager->getRepository(Piece::class)->findByIds($panier);
        $renting = new Renting();
        $renting->setStatuts('pending');
        $renting->setUser($this->getUser());
        $rentingDetail = new RentingDetail();
        $rentingDetail->setPriceOption('1500€');
        foreach ($pieces as $piece) {
            $rentingDetail->addPiece($piece);
        }
        $rentingDetail->setRenting($renting);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($renting);
        $entityManager->persist($rentingDetail);
        $entityManager->flush();
        return $this->redirectToRoute('user_account');
    }
    #[Route('/basket/remove/{id}', name: 'remove_basket')]
    public function remove(Request $request, EntityManagerInterface $entityManager,$id): Response
    {
        // Récupère la piece avec l'id: si l'objet n'existe pas je l'ajoute pas au panier

        $session = $request->getSession();
        // Récupère le panier
     
        $panier = $session->get('basket', []);
        //dump($panier);
        $key = array_search($id,$panier);
        unset($panier[$key]);
        //dd($panier);
        $session->set('basket', $panier);
        return $this->redirectToRoute('basket');
    }
}
