<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Author;
use App\Entity\Member;
<<<<<<< HEAD
use App\Entity\Borrowing;



class AdminController extends AbstractController
{
=======
use App\Entity\Document;

class AdminController extends AbstractController
{

>>>>>>> 93d62b9b947290046a359ac852cdb2e8f08ef5a3
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

    public function listMemberRegLastMonth()
    {
        $month = new \DateInterval('P1M');
        $date = new \DateTime();
        $currentDate = $date->format('Y-m-d H:i:s');
        $oneMonthBefore = $date->sub($month);

<<<<<<< HEAD
        $members = $this->getDoctrine()->getRepository(Member::class)->listMemberRegisteredLastMonth($currentDate, $oneMonthBefore);

=======
        $listMemberRegLastMonth = $this->getDoctrine()->getRepository(Member::class)->listMemberRegisteredLastMonth($currentDate, $oneMonthBefore);
>>>>>>> 93d62b9b947290046a359ac852cdb2e8f08ef5a3
        
        return $this->render('admin/listMemberRegLastMonth.html.twig', [
            'listMemberRegLastMonth' => $members,
        ]);
    }

    public function listDocMostBor()
    {
        $documents = $this->getDoctrine()->getRepository(Borrowing::class)->listDocMostBor();

        return $this->render('admin/listDocMostBorrowing.html.twig', [
            'documents' => $documents,
        ]);
    }

    public function lastDocumentsAdded()
    {
        $documents = $this->getDoctrine()->getRepository(Document::class)->lastDocumentsAdded();

        return $this->render('admin/lastDocumentsAdded.html.twig', [
            'documents' => $documents
        ]);
    }
}
