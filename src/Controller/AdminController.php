<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Author;
use App\Repository\MemberRepository;


class AdminController extends AbstractController
{

    private $memberRep;

    public function __construct(MemberRepository $memberRep)
    {
        $this->memberRep = $memberRep;
    }
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

        $listMemberRegLastMonth = $this->memberRep->listMemberRegisteredLastMonth($currentDate, $oneMonthBefore);
        
        
        return $this->render('admin/listMemberRegLastMonth.html.twig', [
            'listMemberRegLastMonth' => $listMemberRegLastMonth,
        ]);
    }
}
