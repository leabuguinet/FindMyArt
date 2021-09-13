<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PieceRepository;
use App\Twig\AppExtension;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

   
class DisplayPiecesController extends AbstractController
{
    /* #[Route('/api/pieces', name: 'apipieces')] */
     /**
     * @Route("/api/pieces", name="apipieces")
     */
    public function index(Request $request, PieceRepository $pieceRepository,  AppExtension $appExtension): Response
    {
       /*  $pieces = $pieceRepository->findAll();

        $data = [];
        foreach($pieces as $piece) {
            $data[] = $piece->formatedForView();
        }

        return new JsonResponse($data);
     */

        $content = $request->getContent();
        $jsonParameters = json_decode($content, true);
        $hasParameters = isset($jsonParameters['search']) && $jsonParameters['search'];
        $pieces = [];
        $pieces = $pieceRepository->findAll();
        $results = $pieces;

        if ($hasParameters) {
            $search = $jsonParameters['search'];
            $results = array_filter($pieces, function($piece) use ($search) {
                
                if (str_contains(strtolower($piece-> getTitle()), strtolower($search)) || str_contains(strtolower($piece->getArtist()), strtolower($search))||str_contains(strtolower($piece->getStyle()), strtolower($search))) {
                    
                    return true;
                }
                
                else {
                    return false;
                }
            });
        }
        

        $data = [];
        foreach($results as $piece) {
            $pieceFormated = $piece->formatedForView();
            $pieceFormated['findMyArtDisplayImage'] = $appExtension->displayImage($piece, 'imageFile');
            $data[] = $pieceFormated;
        }
        shuffle($data);
        return new JsonResponse([
            'piece' => $data,
            'data' => $results,
            'parameters' => $jsonParameters,
            'A des paramètres ? ' => $hasParameters,
        ]);

        



    }
}