<?php

namespace App\Controller;

use App\Entity\Maintenance;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaintenanceRepository;
use Symfony\Component\HttpFoundation\Response;

class DamagedDocController extends AbstractController
{
    /**
     * @Route("/admin/damageddoc", name="damaged_doc")
     */
    public function index(MaintenanceRepository $mr)
    {
        return $this->render('damaged_doc/index.html.twig', [
            'controller_name' => 'DamagedDocController',
            'maint' => $mr->docEndommage(),

        ]);
    }

}
