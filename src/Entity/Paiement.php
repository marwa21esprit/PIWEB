<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Paiement
 *
 * @ORM\Table(name="paiement", indexes={@ORM\Index(name="id_res", columns={"id_res"})})
 * @ORM\Entity(repositoryClass=App\Repository\PaiementRepository::class)
 */
class Paiement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heure_P", type="datetime", nullable=false)
     */
    private $heureP;

    /**
     * @var \Reservation
     *
     * @ORM\ManyToOne(targetEntity="Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_res", referencedColumnName="id")
     * })
     */
    private $idRes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getHeureP(): ?\DateTimeInterface
    {
        return $this->heureP;
    }

    public function setHeureP(\DateTimeInterface $heureP): static
    {
        $this->heureP = $heureP;

        return $this;
    }

    public function getIdRes(): ?Reservation
    {
        return $this->idRes;
    }

    public function setIdRes(?Reservation $idRes): static
    {
        $this->idRes = $idRes;

        return $this;
    }
    public function __construct()
    {
        $this->heureP = new \DateTime(); // Set the default value to the current date and time
    }

}
