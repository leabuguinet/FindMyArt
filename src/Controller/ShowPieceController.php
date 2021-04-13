<?php

namespace App\Controller;

use App\Entity\Piece;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowPieceController extends AbstractController
{
    #[Route('/show/{id}', name: 'show_piece')]

    public function index(EntityManagerInterface $entityManager,  $id): Response
    {
        $piece = $entityManager->getRepository(Piece::class)->find($id);
        return $this->render('show_piece/index.html.twig', [
            'piece' => $piece,

            
        ]);
    }
}
