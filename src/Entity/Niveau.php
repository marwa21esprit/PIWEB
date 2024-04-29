<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
class Niveau
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"IDENTITY")]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[Assert\NotBlank(message: "Must be filled")]
    #[Assert\Length(
    min: 5,
    minMessage: "Enter a Name composed of at least 5 characters"
    )]
    #[Assert\Type(type: 'string', message: 'The level name must be a string.')]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z ]+$/',
        message: 'The level name can only contain letters and spaces.'
    )]
    #[ORM\Column(type: "string", length: 255)]
    #[Groups("post:read")]

    private ?string $name = null;

    #[Assert\NotBlank(message: "Must be filled")]
    #[ORM\Column(name: "prerequis",length: 255)]
    #[Groups("post:read")]
    private ?string $prerequis = null;

    #[Assert\NotBlank(message: "Must be filled")]
    #[ORM\Column(name: "duree",type: "string")]
    #[Groups("post:read")]
    private ?string $duree = null;

    #[ORM\Column(name: "nbformation", type: "integer")]
    #[Assert\NotBlank(message: "Must be filled")]
    #[Assert\Positive(message: "The training number must be a positive number")]
    #[Assert\GreaterThan(value: 0, message: "The number of training must be greater than zero")]
    #[Groups("post:read")]
    private ?int $nbformation = null;

    #[ORM\Column(name: "certificat",length: 255)]
    #[Assert\NotBlank(message: "Must be filled")]
    #[Groups("post:read")]
    private ?string $certificat = null;

    #[ORM\Column(name: "description",length: 255)]
    #[Assert\NotBlank(message: "Must be filled")]
    #[Groups("post:read")]
    private ?string $description = null;

    #[ORM\Column(name: "image",length: 255)]
   #[Assert\NotBlank(message:"Image must be provided")]
   #[Assert\File(
    maxSize:"5M",
        )]

   #[Groups("post:read")]
    private ?string $image = null;

   

    

    public function __construct()
    {
        $this->participation1s = new ArrayCollection();
      
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrerequis(): ?string
    {
        return $this->prerequis;
    }

    public function setPrerequis(string $prerequis): static
    {
        $this->prerequis = $prerequis;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNbformation(): ?int
    {
        return $this->nbformation;
    }

    public function setNbformation(int $nbformation): static
    {
        $this->nbformation = $nbformation;

        return $this;
    }

    public function getCertificat(): ?string
    {
        return $this->certificat;
    }

    public function setCertificat(string $certificat): static
    {
        $this->certificat = $certificat;

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


   

   

   
}
