<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PieceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    #[Route('/api/pieces', name: 'home')]
    public function index(PieceRepository $pieceRepository): Response
    {
        $pieces = $pieceRepository->findAll();

        $data = [];
        foreach($pieces as $piece) {
            $data[] = $piece->formatedForView();
        }

        return new JsonResponse($data);
    
    }

    /**
     * @Route("/{reactRouting}", name="homepage", defaults={"reactRouting": null})
     */
    public function base(): Response
    {
        return $this->render('base.html.twig');
    }

    
   
}