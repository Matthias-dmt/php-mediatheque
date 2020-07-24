<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\RelaunchService;
use App\Entity\Borrowing;

class MailerController extends AbstractController
{

    /**
     * @Route("/relaunchEmail")
     */
    public function sendRelaunchEmail(RelaunchService $relaunchService)
    {
        $users = $this->getDoctrine()->getRepository(Borrowing::class)->membersNotDeliveredOnTime();
        $relaunchService->relaunchSystem();

        return $this->render('mailer/relaunch.html.twig', [
            'user' => $users[1],
        ]);
    }
}
