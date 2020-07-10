<?php

namespace App\Entity;

use App\Repository\ParticipatesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipatesRepository::class)
 */
class Participates
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $places;

    /**
     * @ORM\ManyToOne(targetEntity=MeetUp::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $meetUp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(?int $places): self
    {
        $this->places = $places;

        return $this;
    }

    public function getMeetUp(): ?MeetUp
    {
        return $this->meetUp;
    }

    public function setMeetUp(?MeetUp $meetUp): self
    {
        $this->meetUp = $meetUp;

        return $this;
    }
}
