<?php
namespace App\Service;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RelaunchService extends AbstractController
{

    public function relaunchSystem (\Swift_Mailer $mailer)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find(1);

        $email = (new \Swift_Message('Médiathèque : Email de relance'))
        ->setFrom('lucas.riuk@gmail.com')
        ->setTo($user->getEmail())
        ->setBody(
            $this->renderView(
                'mailer/relaunch.html.twig',
                ['user' => $user]
            ),
            'text/html'
        );

        $mailer->send($email);
    }
}