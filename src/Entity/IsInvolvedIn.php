<?php

namespace App\Entity;

use App\Repository\IsInvolvedInRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IsInvolvedInRepository::class)
 */
class IsInvolvedIn
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
