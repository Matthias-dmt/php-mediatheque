<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastName;

    /**
     * @ORM\ManyToMany(targetEntity=Document::class, mappedBy="authorId")
     */
    private $authorId;

    /**
     * @ORM\ManyToMany(targetEntity=Document::class, mappedBy="authorId")
     */
    private $documentId;

    public function __construct()
    {
        $this->authorId = new ArrayCollection();
        $this->documentId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocumentId(): Collection
    {
        return $this->documentId;
    }

    public function addDocumentId(Document $documentId): self
    {
        if (!$this->documentId->contains($documentId)) {
            $this->documentId[] = $documentId;
            $documentId->addAuthorId($this);
        }

        return $this;
    }

    public function removeDocumentId(Document $documentId): self
    {
        if ($this->documentId->contains($documentId)) {
            $this->documentId->removeElement($documentId);
            $documentId->removeAuthorId($this);
        }

        return $this;
    }
}
