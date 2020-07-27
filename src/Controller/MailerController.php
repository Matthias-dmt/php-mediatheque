<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\RelaunchService;
use App\Entity\Borrowing;

class MailerController extends AbstractController
{

    private $relaunchService;

    public function __construct(RelaunchService $relaunchService)
    {
        $this->relaunchService = $relaunchService;
    }

    /**
     * @Route("/relaunchEmail", name="relaunch_email")
     */
    public function sendRelaunchEmail()
    {
        $borrowings = $this->getDoctrine()->getRepository(Borrowing::class)->borrowedNotDelivered();
        $borrowingsRetard = [];

        function NbJours($debut, $fin)
        {
            $diff = $debut->diff($fin)->format("%a");
            return $diff;
        }

        foreach ($borrowings as $borrowing) {
            $nbJours = NbJours($borrowing['expectedReturnDate'], new \DateTime('now'));
            $borrowing["days"] = $nbJours;
            $borrowingsRetard[] = $borrowing;
        }

        $this->relaunchService->relaunchSystem($borrowingsRetard);
        $this->addFlash('success', 'Mails envoyés !');
        return $this->redirectToRoute('borrowing_retard');
    }
}
