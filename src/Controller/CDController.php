<?php

namespace App\Controller;

use App\Entity\CD;
use App\Form\CDType;
use App\Repository\CDRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cd")
 */
class CDController extends AbstractController
{
    /**
     * @Route("/", name="cd_index", methods={"GET"})
     */
    public function index(CDRepository $cDRepository): Response
    {
        return $this->render('cd/index.html.twig', [
            'cds' => $cDRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cd_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cD = new CD();
        $form = $this->createForm(CDType::class, $cD);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cD);
            $entityManager->flush();

            return $this->redirectToRoute('cd_index');
        }

        return $this->render('cd/new.html.twig', [
            'cd' => $cD,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cd_show", methods={"GET"})
     */
    public function show(CD $cD): Response
    {
        return $this->render('cd/show.html.twig', [
            'cd' => $cD,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cd_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CD $cD): Response
    {
        $form = $this->createForm(CDType::class, $cD);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cd_index');
        }

        return $this->render('cd/edit.html.twig', [
            'cd' => $cD,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cd_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CD $cD): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cD->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cD);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cd_index');
    }
}
