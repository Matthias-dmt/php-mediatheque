<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Author;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/baseAdmin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    public function findMostAuthorsInCatalog()
    {
        $authors = $this->getDoctrine()->getRepository(Author::class)->findMostAuthorsInCatalog();

        return $this->render('admin/findMostAuthorsInCatalog.html.twig', [
            'authors' => $authors
        ]);
    }
}
