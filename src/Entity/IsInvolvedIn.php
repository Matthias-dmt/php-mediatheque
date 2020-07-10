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
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
   
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity=Document::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $documentId;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $authorId;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getDocumentId(): ?Document
    {
        return $this->documentId;
    }

    public function setDocumentId(?Document $documentId): self
    {
        $this->documentId = $documentId;

        return $this;
    }

    public function getAuthorId(): ?Author
    {
        return $this->authorId;
    }

    public function setAuthorId(?Author $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }
}
