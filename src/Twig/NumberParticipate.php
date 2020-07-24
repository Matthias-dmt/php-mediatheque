<?php

namespace App\Twig;

use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use App\Entity\Participates;

class NumberParticipate extends AbstractExtension
{

    private $manager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('totalPlaces', [$this, 'numberParticipate']),
        ];
    }

    public function numberParticipate($meetUpId)
    {

        $participatesRep = $this->manager->getRepository(Participates::class);

        $numberPlaces = $participatesRep->numberPlacesReserved($meetUpId);
        

        return " nombre de participants inscrits : ".$numberPlaces[0]['totalPlaces'];
    }
}