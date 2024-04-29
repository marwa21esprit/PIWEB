<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Niveau;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CertificatRepository;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CertificatRepository::class)]
class Certificat
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(name: "id_certificat", type: "integer")]
    private ?int $idCertificat = null;


    #[ORM\Column(length :255)]
    #[Assert\NotBlank]
    private ?string $nomCertificat;

    #[ORM\Column(length :255)]
    private ?string $domaineCertificat;

    #[ORM\Column(length :255)]
    private ?string $niveau;

    #[ORM\Column(type: "datetime")]
    #[Assert\NotBlank(message: "La date de l'événement ne doit pas être vide.")]
    #[Assert\GreaterThan("today", message: "La date de l'événement doit être ultérieure à la date actuelle.")]
    #[Assert\Type(type: "\DateTimeInterface", message: "La date de l'événement doit être de type date.")]
    private ?DateTime $dateObtentionCertificat;


   #[ORM\ManyToOne(targetEntity:"Etablissement")]
   #[ORM\JoinColumn(name:"ID_Etablissement", referencedColumnName:"ID_Etablissement")]
    private $idEtablissement;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="certificat")
     */
    private Collection $niveaux;

    public function __construct()
    {
        $this->niveaux = new ArrayCollection();
    }

    public function getIdCertificat(): ?int
    {
        return $this->idCertificat;
    }

    public function getNomCertificat(): ?string
    {
        return $this->nomCertificat;
    }

    public function setNomCertificat(string $nomCertificat): static
    {
        $this->nomCertificat = $nomCertificat;

        return $this;
    }

    public function getDomaineCertificat(): ?string
    {
        return $this->domaineCertificat;
    }

    public function setDomaineCertificat(string $domaineCertificat): static
    {
        $this->domaineCertificat = $domaineCertificat;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getDateObtentionCertificat(): ?\DateTimeInterface
    {
        return $this->dateObtentionCertificat;
    }

    public function setDateObtentionCertificat(\DateTimeInterface $dateObtentionCertificat): static
    {
        $this->dateObtentionCertificat = $dateObtentionCertificat;

        return $this;
    }

    public function getIdEtablissement(): ?Etablissement
    {
        return $this->idEtablissement;
    }

    public function setIdEtablissement(?Etablissement $idEtablissement): static
    {
        $this->idEtablissement = $idEtablissement;

        return $this;
    }




}
