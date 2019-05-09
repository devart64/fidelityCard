<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarteDeFideliteRepository")
 */
class CarteDeFidelite
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
    private $created_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_client;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_tampon;

    /**
     * @ORM\Column(type="integer")
     */
    private $dernier_tampon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client): void
    {
        $this->id_client = $id_client;
    }

    /**
     * @return mixed
     */
    public function getNbTampon()
    {
        return $this->nb_tampon;
    }

    /**
     * @param mixed $nb_tampon
     */
    public function setNbTampon($nb_tampon): void
    {
        $this->nb_tampon = $nb_tampon;
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
