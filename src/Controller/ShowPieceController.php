<?php

namespace App\Controller;

use App\Entity\Piece;
use App\Twig\AppExtension;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Storage\StorageInterface;

class ShowPieceController extends AbstractController
{
    #[Route('/show/{id}', name: 'show_piece')]

    public function index(EntityManagerInterface $entityManager, $id, StorageInterface $storageInterface): Response
    {
        $piece = $entityManager->getRepository(Piece::class)->find($id);

        $imagePath = $storageInterface->resolvePath($piece, 'imageFile');
        // TODO : utilisation de la lib : https://ourcodeworld.com/articles/read/356/how-to-extract-prominent-colors-from-an-image-in-symfony-3

        return $this->render('show_piece/index.html.twig', [
            'piece' => $piece,

            
        ]);
    }
}
