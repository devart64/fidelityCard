<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TamponRepository")
 */
class Tampon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idCarteFidelite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="integer")
     */
    private $isCocher;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCarteFidelite(): ?int
    {
        return $this->idCarteFidelite;
    }

    public function setIdCarteFidelite(int $idCarteFidelite): self
    {
        $this->idCarteFidelite = $idCarteFidelite;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getIsCocher()
    {
        return $this->isCocher;
    }

    /**
     * @param mixed $isCocher
     */
    public function setIsCocher($isCocher): void
    {
        $this->isCocher = $isCocher;
    }




}
