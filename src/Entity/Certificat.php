<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Certificat
 *
 * @ORM\Table(name="certificat", indexes={@ORM\Index(name="ID_Etablissement", columns={"ID_Etablissement"})})
 * @ORM\Entity
 */
class Certificat
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Certificat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCertificat;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Certificat", type="string", length=255, nullable=false)
     */
    private $nomCertificat;

    /**
     * @var string
     *
     * @ORM\Column(name="Domaine_Certificat", type="string", length=255, nullable=false)
     */
    private $domaineCertificat;

    /**
     * @var string
     *
     * @ORM\Column(name="Niveau", type="string", length=255, nullable=false)
     */
    private $niveau;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Obtention_Certificat", type="date", nullable=false)
     */
    private $dateObtentionCertificat;

    /**
     * @var \Etablissement
     *
     * @ORM\ManyToOne(targetEntity="Etablissement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Etablissement", referencedColumnName="ID_Etablissement")
     * })
     */
    private $idEtablissement;

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
