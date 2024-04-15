<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;


#[ORM\Entity]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "idEvent", type: "integer", nullable: false)]
    private $idevent;

    #[ORM\Column(name: "nameEvent", type: "string", length: 100, nullable: false)]
    private $nameevent;

    #[ORM\Column(name: "dateEvent", type: "date", nullable: false)]
    private $dateevent;

    #[ORM\Column(name: "nbrMax", type: "integer", nullable: false)]
    private $nbrmax;

    #[ORM\Column(name: "prix", type: "float", precision: 10, scale: 0, nullable: false)]
    private $prix;

    #[ORM\Column(name: "description", type: "string", length: 100, nullable: false)]
    private $description;

    #[ORM\Column(name: "image", type: "string", length: 100, nullable: false)]
    private $image;

    #[ORM\ManyToOne(targetEntity: "Etablissement")]
    #[ORM\JoinColumn(name: "idEstab", referencedColumnName: "ID_Etablissement")]
    private $idestab;

    #[ORM\ManyToOne(targetEntity: "Partner")]
    
        #[ORM\JoinColumn(name: "idPartnerCE", referencedColumnName: "idPartner")]
    
    private $idpartnerce;


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
