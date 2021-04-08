<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PieceRepository;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(PieceRepository $pieceRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'pieces' => $pieceRepository->findAll(),
        ]);
    }
    

      /**
     * @Route("/", name="homepage", methods={"GET","POST"})
     */
    public function base(): Response
    {
        return $this->render('base.html.twig');
    }

    
   
}