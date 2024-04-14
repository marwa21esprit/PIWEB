<?php

namespace App\Entity;

<<<<<<< HEAD
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Etablissement
 *
 * @ORM\Table(name="etablissement")
 * @ORM\Entity
 */
class Etablissement
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Etablissement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="img_Etablissement", type="string", length=255, nullable=false)
     */
    private $imgEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Etablissement", type="string", length=255, nullable=false)
     */
    private $nomEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse_Etablissement", type="string", length=255, nullable=false)
     */
    private $adresseEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_Etablissement", type="string", length=255, nullable=false)
     */
    private $typeEtablissement;

    /**
     * @var int
     *
     * @ORM\Column(name="Tel_Etablissement", type="integer", nullable=false)
     */
    private $telEtablissement;

    /**
     * @var string
     *
     * @ORM\Column(name="Directeur_Etablissement", type="string", length=255, nullable=false)
     */
    private $directeurEtablissement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Fondation", type="date", nullable=false)
     */
    private $dateFondation;

    public function getIdEtablissement(): ?int
    {
        return $this->idEtablissement;
=======
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtablissementRepository;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EtablissementRepository::class)]

class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(name: "ID_Etablissement", type: "integer")]
    private ?int $ID_Etablissement;


    #[ORM\Column(length :255)]
    private ?string $imgEtablissement ;

    #[ORM\Column(length :255)]
    #[Assert\NotBlank(message: 'The establishment name cannot be blank.')]
    #[Assert\Type(type: 'string', message: 'The establishment name must be a string.')]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z ]+$/',
        message: 'The establishment name can only contain letters and spaces.'
    )]
    private ?string $nomEtablissement;

    #[ORM\Column(length :255)]
    private ?string $adresseEtablissement;

    #[ORM\Column(length :255)]
    private ?string $typeEtablissement;

    #[Assert\Regex(
        pattern: '/^\d{8}$/',
        message: 'The telephone number must contain exactly 8 digits.'
    )]
    #[ORM\Column(type: "integer")]
    private ?int $telEtablissement;

    #[ORM\Column(length :255)]
    #[Assert\NotBlank(message: 'The director name cannot be blank.')]
    #[Assert\Type(type: 'string', message: 'The director name must be a string.')]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z ]+$/',
        message: 'The director name can only contain letters and spaces.'
    )]
    private ?string$directeurEtablissement;

    #[ORM\Column(type: "datetime")]
    #[Assert\LessThan("today", message: "The date of foundation must be less than today")]
    private ?DateTime $dateFondation;

    public function getIdEtablissement(): ?int
    {
        return $this->ID_Etablissement;
>>>>>>> main
    }

    public function getImgEtablissement(): ?string
    {
        return $this->imgEtablissement;
    }

    public function setImgEtablissement(string $imgEtablissement): static
    {
        $this->imgEtablissement = $imgEtablissement;

        return $this;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->nomEtablissement;
    }

    public function setNomEtablissement(string $nomEtablissement): static
    {
        $this->nomEtablissement = $nomEtablissement;

        return $this;
    }

    public function getAdresseEtablissement(): ?string
    {
        return $this->adresseEtablissement;
    }

    public function setAdresseEtablissement(string $adresseEtablissement): static
    {
        $this->adresseEtablissement = $adresseEtablissement;

        return $this;
    }

    public function getTypeEtablissement(): ?string
    {
        return $this->typeEtablissement;
    }

    public function setTypeEtablissement(string $typeEtablissement): static
    {
        $this->typeEtablissement = $typeEtablissement;

        return $this;
    }

    public function getTelEtablissement(): ?int
    {
        return $this->telEtablissement;
    }

    public function setTelEtablissement(int $telEtablissement): static
    {
        $this->telEtablissement = $telEtablissement;

        return $this;
    }

    public function getDirecteurEtablissement(): ?string
    {
        return $this->directeurEtablissement;
    }

    public function setDirecteurEtablissement(string $directeurEtablissement): static
    {
        $this->directeurEtablissement = $directeurEtablissement;

        return $this;
    }

    public function getDateFondation(): ?\DateTimeInterface
    {
        return $this->dateFondation;
    }

    public function setDateFondation(\DateTimeInterface $dateFondation): static
    {
        $this->dateFondation = $dateFondation;

        return $this;
    }


}
