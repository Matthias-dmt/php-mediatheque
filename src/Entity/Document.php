<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
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
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity=Author::class, inversedBy="documentId")
     */
    private $authorId;

    public function __construct()
    {
        $this->authorId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Author[]
     */
    public function getAuthorId(): Collection
    {
        return $this->authorId;
    }

    public function addAuthorId(Author $authorId): self
    {
        if (!$this->authorId->contains($authorId)) {
            $this->authorId[] = $authorId;
        }

        return $this;
    }

    public function removeAuthorId(Author $authorId): self
    {
        if ($this->authorId->contains($authorId)) {
            $this->authorId->removeElement($authorId);
        }

        return $this;
    }
}
