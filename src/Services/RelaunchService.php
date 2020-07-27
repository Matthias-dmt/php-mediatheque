<?php

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RelaunchService extends AbstractController
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function relaunchSystem($borrowings)
    {
        foreach ($borrowings as $borrowing) {
            if ($borrowing['days'] < 182) { // 6 mois
                $email = (new \Swift_Message('Médiathèque : Email de relance'))
                    ->setFrom('lucas.riuk@gmail.com')
                    ->setTo($borrowing['email'])
                    ->setBody(
                        $this->renderView(
                            'mailer/relaunch.html.twig',
                            ['borrowing' => $borrowing]
                        ),
                        'text/html'
                    );

                $this->mailer->send($email);
            } else {
                $email = (new \Swift_Message('Médiathèque : Email de pénalité'))
                    ->setFrom('lucas.riuk@gmail.com')
                    ->setTo($borrowing['email'])
                    ->setBody(
                        $this->renderView(
                            'mailer/penalty.html.twig',
                            ['borrowing' => $borrowing]
                        ),
                        'text/html'
                    );

                $this->mailer->send($email);
            }
        }
    }
}
