<?php

namespace App\Entity;

use DateTime;

use Doctrine\Common\Collections\ArrayCollection;


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

    #[Assert\NotBlank(message: "La date de l'événement ne doit pas être vide.")]
    #[Assert\GreaterThan("today", message: "La date de l'événement doit être ultérieure à la date actuelle.")]
    #[Assert\Type(type: "\DateTimeInterface", message: "La date de l'événement doit être de type date.")]
    private ?DateTime $dateFondation;

    #[ORM\OneToMany(mappedBy: "etablissement", targetEntity: UserEtablissement::class)]
    private $userEtablissements;

    private $likes = 0;
    private $dislikes = 0;

    public function __construct()
    {
        $this->userEtablissements = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getUserEtablissements(): ArrayCollection
    {
        return $this->userEtablissements;
    }

    /**
     * @param ArrayCollection $userEtablissements
     */
    public function setUserEtablissements(ArrayCollection $userEtablissements): void
    {
        $this->userEtablissements = $userEtablissements;
    }

    /**
     * @return int
     */
    public function getLikes(): int
    {
        return $this->likes;
    }

    /**
     * @param int $likes
     */
    public function setLikes(int $likes): void
    {
        $this->likes = $likes;
    }

    /**
     * @return int
     */
    public function getDislikes(): int
    {
        return $this->dislikes;
    }

    /**
     * @param int $dislikes
     */
    public function setDislikes(int $dislikes): void
    {
        $this->dislikes = $dislikes;
    }


    #[Assert\LessThan("today", message: "The date of foundation must be less than today")]
    private ?DateTime $dateFondation;

    public function getIdEtablissement(): ?int
    {
        return $this->ID_Etablissement;
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
