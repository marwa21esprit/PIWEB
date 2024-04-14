<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="idEstab", columns={"idEstab"}), @ORM\Index(name="fk_partner", columns={"idPartnerCE"})})
 * @ORM\Entity
 */
class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEvent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;

    /**
     * @var string
     *
     * @ORM\Column(name="nameEvent", type="string", length=100, nullable=false)
     */
    private $nameevent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEvent", type="date", nullable=false)
     */
    private $dateevent;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrMax", type="integer", nullable=false)
     */
    private $nbrmax;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=false)
     */
    private $image;

    /**
     * @var \Partner
     *
     * @ORM\ManyToOne(targetEntity="Partner")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPartnerCE", referencedColumnName="idPartner")
     * })
     */
    private $idpartnerce;

    /**
     * @var \Etablissement
     *
     * @ORM\ManyToOne(targetEntity="Etablissement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEstab", referencedColumnName="ID_Etablissement")
     * })
     */
    private $idestab;

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function getNameevent(): ?string
    {
        return $this->nameevent;
    }

    public function setNameevent(string $nameevent): static
    {
        $this->nameevent = $nameevent;

        return $this;
    }

    public function getDateevent(): ?\DateTimeInterface
    {
        return $this->dateevent;
    }

    public function setDateevent(\DateTimeInterface $dateevent): static
    {
        $this->dateevent = $dateevent;

        return $this;
    }

    public function getNbrmax(): ?int
    {
        return $this->nbrmax;
    }

    public function setNbrmax(int $nbrmax): static
    {
        $this->nbrmax = $nbrmax;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getIdpartnerce(): ?Partner
    {
        return $this->idpartnerce;
    }

    public function setIdpartnerce(?Partner $idpartnerce): static
    {
        $this->idpartnerce = $idpartnerce;

        return $this;
    }

    public function getIdestab(): ?Etablissement
    {
        return $this->idestab;
    }

    public function setIdestab(?Etablissement $idestab): static
    {
        $this->idestab = $idestab;

        return $this;
    }


}
