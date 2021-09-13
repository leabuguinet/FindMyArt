<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Renting;
use App\Form\RentingType;
use App\Repository\RentingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserAccountController extends AbstractController
{
    /* #[Route('/user/account', name: 'user_account')] */
    /**
     * @Route("/user/account", name="user_account")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('user_account/index.html.twig', [
            'user' => $user,            
            'rentings' => $user->getRentings(),
        ]);
    }

}
