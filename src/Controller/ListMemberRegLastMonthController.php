<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Member;
use App\Repository\MemberRepository;



class ListMemberRegLastMonthController extends AbstractController
{
    private $memberRep;

    public function __construct(MemberRepository $memberRep)
    {
        $this->memberRep = $memberRep;
    }
    /**
     * @Route("/list/member/reg/last/month", name="list_member_reg_last_month")
     */
    public function index()
    {
        $month = new \DateInterval('P1M');
        $date = new \DateTime();
        $currentDate = $date->format('Y-m-d H:i:s');
        $oneMonthBefore = $date->sub($month);
        var_dump($currentDate);
        var_dump($oneMonthBefore);


        $listMemberRegLastMonth = $this->memberRep->listMemberRegisteredLastMonth($currentDate, $oneMonthBefore);
        
        
        return $this->render('list_member_reg_last_month/index.html.twig', [
            'controller_name' => 'ListMemberRegLastMonthController',
            'listMemberRegLastMonth' => $listMemberRegLastMonth,
        ]);
    }
}
