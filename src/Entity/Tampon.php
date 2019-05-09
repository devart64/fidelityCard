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
    private $idFidelityCard;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $dernier_tampon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdFidelityCard(): ?int
    {
        return $this->idFidelityCard;
    }

    public function setIdFidelityCard(int $idFidelityCard): self
    {
        $this->idFidelityCard = $idFidelityCard;

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
    public function getDernierTampon()
    {
        return $this->dernier_tampon;
    }

    /**
     * @param mixed $dernier_tampon
     */
    public function setDernierTampon($dernier_tampon): void
    {
        $this->dernier_tampon = $dernier_tampon;
    }


}
