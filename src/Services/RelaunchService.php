<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Borrowing;

class RelaunchService extends AbstractController
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function relaunchSystem()
    {
        $users = $this->getDoctrine()->getRepository(Borrowing::class)->borrowedNotDelivered();

        foreach ($users as $user) {
            $email = (new \Swift_Message('Médiathèque : Email de relance'))
                ->setFrom('lucas.riuk@gmail.com')
                ->setTo($user['email'])
                ->setBody(
                    $this->renderView(
                        'mailer/relaunch.html.twig',
                        ['user' => $user]
                    ),
                    'text/html'
                );

            $this->mailer->send($email);
        }
    }
}
