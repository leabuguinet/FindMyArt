<?php

namespace App\Controller;

use App\Entity\Owner;
use App\Form\OwnerType;
use App\Repository\OwnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/owner")
 */
class OwnerController extends AbstractController
{
    /**
     * @Route("/", name="owner_index", methods={"GET"})
     */
    public function index(OwnerRepository $ownerRepository): Response
    {
        return $this->render('owner/index.html.twig', [
            'owners' => $ownerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="owner_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(OwnerType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
            die('stop');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($owner);
            $entityManager->flush();

            return $this->redirectToRoute('owner_index');
        }

        return $this->render('owner/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="owner_show", methods={"GET"})
     */
    public function show(Owner $owner): Response
    {
        return $this->render('owner/show.html.twig', [
            'owner' => $owner,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="owner_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Owner $owner): Response
    {
        $form = $this->createForm(OwnerType::class, $owner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('owner_index');
        }

        return $this->render('owner/edit.html.twig', [
            'owner' => $owner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="owner_delete", methods={"POST"})
     */
    public function delete(Request $request, Owner $owner): Response
    {
        if ($this->isCsrfTokenValid('delete'.$owner->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($owner);
            $entityManager->flush();
        }

        return $this->redirectToRoute('owner_index');
    }
}
