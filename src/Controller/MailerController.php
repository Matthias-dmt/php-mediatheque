<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\RelaunchService;
use App\Entity\User;


class MailerController extends AbstractController
{

    /**
     * @Route("/relaunchEmail")
     */
    public function sendRelaunchEmail(\Swift_Mailer $mailer, RelaunchService $relaunchService)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find(1);
        $relaunchService->relaunchSystem($mailer);

        return $this->render('mailer/relaunch.html.twig', [
            'user' => $user,
        ]);
    }
}
