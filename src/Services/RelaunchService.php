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

        foreach ($borrowingsRetard as $borrowingRetard) {
            if ($borrowingRetard['days'] < 182) { //6 mois
                $email = (new \Swift_Message('Médiathèque : Email de relance'))
                    ->setFrom('lucas.riuk@gmail.com')
                    ->setTo($borrowingRetard['email'])
                    ->setBody(
                        $this->renderView(
                            'mailer/relaunch.html.twig',
                            ['borrowing' => $borrowingRetard]
                        ),
                        'text/html'
                    );

                $this->mailer->send($email);
            } else {
                $email = (new \Swift_Message('Médiathèque : Email de pénalité'))
                ->setFrom('lucas.riuk@gmail.com')
                ->setTo($borrowingRetard['email'])
                ->setBody(
                    $this->renderView(
                        'mailer/penalty.html.twig',
                        ['borrowing' => $borrowingRetard]
                    ),
                    'text/html'
                );

            $this->mailer->send($email);
            }
        }
    }
}
