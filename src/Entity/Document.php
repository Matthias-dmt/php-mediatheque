<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"document" = "Document", "book" = "Book", "cd" = "CD", "dvd" = "DVD", "ebook" = "EBook", "journal" = "Journal"})
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cote;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $format;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeOeuvre;

    /**
     * @ORM\OneToMany(targetEntity=Maintenance::class, mappedBy="document")
     */
    private $maintenances;

    public function __construct()
    {
        $this->authorId = new ArrayCollection();
        $this->maintenances = new ArrayCollection();
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

    public function getCote(): ?string
    {
        return $this->cote;
    }

    public function setCote(string $cote): self
    {
        $this->cote = $cote;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getCodeOeuvre(): ?string
    {
        return $this->codeOeuvre;
    }

    public function setCodeOeuvre(string $codeOeuvre): self
    {
        $this->codeOeuvre = $codeOeuvre;

        return $this;
    }

    /**
     * @return Collection|Maintenance[]
     */
    public function getMaintenances(): Collection
    {
        return $this->maintenances;
    }

    public function addMaintenance(Maintenance $maintenance): self
    {
        if (!$this->maintenances->contains($maintenance)) {
            $this->maintenances[] = $maintenance;
            $maintenance->setDocument($this);
        }

        return $this;
    }

    public function removeMaintenance(Maintenance $maintenance): self
    {
        if ($this->maintenances->contains($maintenance)) {
            $this->maintenances->removeElement($maintenance);
            // set the owning side to null (unless already changed)
            if ($maintenance->getDocument() === $this) {
                $maintenance->setDocument(null);
            }
        }

        return $this;
    }
}
