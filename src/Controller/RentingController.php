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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/* #[Route('/renting')] */
/**
* @Route("/renting")
*/
class RentingController extends AbstractController
{
    /* #[Route('/', name: 'renting_index', methods: ['GET'])] */
    /**
     * @Route("/", name="renting_index", methods={"GET"})
     */
    public function index(RentingRepository $rentingRepository): Response
    {
        return $this->render('renting/index.html.twig', [
            'rentings' => $rentingRepository->findAll(),
        ]);
    }

    /* #[Route('/new', name: 'renting_new', methods: ['GET', 'POST'])] */
    /**
     * @Route("/new", name="renting_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $renting = new Renting();
        $form = $this->createForm(RentingType::class, $renting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($renting);
            $entityManager->flush();

            return $this->redirectToRoute('renting_index');
        }

        return $this->render('renting/new.html.twig', [
            'renting' => $renting,
            'form' => $form->createView(),
        ]);
    }

    /* #[Route('/{id}', name: 'renting_show', methods: ['GET'])] */
    /**
     * @Route("/{id}", name="renting_show", methods={"GET"})
     */
    public function show(Renting $renting, EntityManagerInterface $entityManager, $id): Response
    {
        $user = $this->getUser();
        $renting = $entityManager->getRepository(Renting::class)->find($id);
        return $this->render('renting/show.html.twig', [
            'user' => $user,            
            'rentings' => $user->getRentings(),
            'renting' => $renting,
        ]);
    }

    /* #[Route('/{id}/edit', name: 'renting_edit', methods: ['GET', 'POST'])] */
    /**
     * @Route("/{id}/edit", name="renting_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Renting $renting): Response
    {
        $form = $this->createForm(RentingType::class, $renting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('renting_index');
        }

        return $this->render('renting/edit.html.twig', [
            'renting' => $renting,
            'form' => $form->createView(),
        ]);
    }

    /* #[Route('/{id}', name: 'renting_delete', methods: ['POST'])] */
    /**
     * @Route("/{id}", name="renting_delete", methods={"POST"})
     */
    public function delete(Request $request, Renting $renting): Response
    {
        if ($this->isCsrfTokenValid('delete'.$renting->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($renting);
            $entityManager->flush();
        }

        return $this->redirectToRoute('renting_index');
    }
}
