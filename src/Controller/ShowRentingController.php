<?php


namespace App\Controller;

use App\Entity\User;
use App\Entity\Renting;
use App\Form\RentingType;
use App\Form\RentingDetailType;
use App\Repository\RentingRepository;
use App\Repository\RentingDetailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowRentingController extends AbstractController
{
    #[Route('/show/renting/{id}', name: 'show_renting', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, $id): Response
    {
        $user = $this->getUser();
        $renting = $entityManager->getRepository(Renting::class)->find($id);
        return $this->render('show_renting/index.html.twig', [
            'user' => $user,            
            'rentings' => $user->getRentings(),
            'renting' => $renting,
        ]);
    }
}
