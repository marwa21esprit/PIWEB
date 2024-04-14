<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partner
 *
 * @ORM\Table(name="partner")
 * @ORM\Entity
 */
class Partner
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPartner", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpartner;

    /**
     * @var string
     *
     * @ORM\Column(name="namePartner", type="string", length=100, nullable=false)
     */
    private $namepartner;

    /**
     * @var string
     *
     * @ORM\Column(name="typePartner", type="string", length=100, nullable=false)
     */
    private $typepartner;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer", nullable=false)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=1000, nullable=false)
     */
    private $image;

    public function getIdpartner(): ?int
    {
        return $this->idpartner;
    }

    public function getNamepartner(): ?string
    {
        return $this->namepartner;
    }

    public function setNamepartner(string $namepartner): static
    {
        $this->namepartner = $namepartner;

        return $this;
    }

    public function getTypepartner(): ?string
    {
        return $this->typepartner;
    }

    public function setTypepartner(string $typepartner): static
    {
        $this->typepartner = $typepartner;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }


}
