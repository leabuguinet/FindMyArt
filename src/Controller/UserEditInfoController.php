<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserEditType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserEditInfoController extends AbstractController
{
    #[Route('/{id}/user/edit/info', name: 'user_edit_info', methods: ['GET', 'POST'])]
        public function edit(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder): Response
        {
            $form = $this->createForm(UserEditType::class, $user);
            $form->handleRequest($request);
            $user = $this->getUser();
    
            if ($form->isSubmitted() && $form->isValid()) {
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
    
                $this->getDoctrine()->getManager()->flush();
    
                return $this->redirectToRoute('user_account');
        }

        return $this->render('user_edit_info/index.html.twig', [
            'controller_name' => 'UserEditInfoController',
            "form" => $form->createView() ,
            'user' => $user, 
        ]);
    }
}
