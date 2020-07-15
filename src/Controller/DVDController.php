<?php

namespace App\Controller;

use App\Entity\DVD;
use App\Form\DVDType;
use App\Repository\DVDRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dvd")
 */
class DVDController extends AbstractController
{
    /**
     * @Route("/", name="dvd_index", methods={"GET"})
     */
    public function index(DVDRepository $dVDRepository): Response
    {
        return $this->render('dvd/index.html.twig', [
            'dvds' => $dVDRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dvd_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dVD = new DVD();
        $form = $this->createForm(DVDType::class, $dVD);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dVD);
            $entityManager->flush();

            return $this->redirectToRoute('dvd_index');
        }

        return $this->render('dvd/new.html.twig', [
            'dvd' => $dVD,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dvd_show", methods={"GET"})
     */
    public function show(DVD $dVD): Response
    {
        return $this->render('dvd/show.html.twig', [
            'dvd' => $dVD,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dvd_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DVD $dVD): Response
    {
        $form = $this->createForm(DVDType::class, $dVD);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dvd_index');
        }

        return $this->render('dvd/edit.html.twig', [
            'dvd' => $dVD,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dvd_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DVD $dVD): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dVD->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dVD);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dvd_index');
    }
}
