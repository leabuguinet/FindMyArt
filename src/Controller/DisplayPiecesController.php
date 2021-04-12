<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PieceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
   
   
   /* VERSION DES ROUTES POUR REACT APP  */
   
   
class DisplayPiecesController extends AbstractController
{
    #[Route('/api/pieces', name: 'home')]
    public function index(Request $request): Response
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
        $results = $pieces;

        if ($hasParameters) {
            $search = $jsonParameters['search'];
            $results = array_filter($pieces, function($piece) use ($search) {
                // Si miel contient la chaîne de caractères
                if (str_contains($piece, $search)) {
                    // On le garde
                    return true;
                }
                // Sinon, on ne le garde pas
                else {
                    return false;
                }
            });
        }

        return new JsonResponse([
            'data' => $results,
            'paramaters' => $jsonParameters,
            'A des paramètres ? ' => $hasParameters,
            'message' => 'coucou',
        ]);




    }
}