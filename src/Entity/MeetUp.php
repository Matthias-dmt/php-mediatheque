<?php

namespace App\Entity;

use App\Repository\MeetUpRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeetUpRepository::class)
 */
class MeetUp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity=Author::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $guest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getGuest(): ?Author
    {
        return $this->guest;
    }

    public function setGuest(Author $guest): self
    {
        $this->guest = $guest;

        return $this;
    }
}
