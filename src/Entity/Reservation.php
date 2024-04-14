<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_user", columns={"id_user"}), @ORM\Index(name="fk_event", columns={"id_event"})})
 * @ORM\Entity(repositoryClass=App\Repository\ReservationRepository::class)
 */
class Reservation
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
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_places", type="integer", nullable=false)
     */
    private $nbPlaces;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imageSrc", type="string", length=100, nullable=true)
     */
    private $imagesrc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nameE", type="string", length=100, nullable=true)
     */
    private $namee;

    /**
     * @var float|null
     *
     * @ORM\Column(name="eventPrice", type="float", precision=10, scale=0, nullable=true)
     */
    private $eventprice;

    /**
     * @var \Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_event", referencedColumnName="idEvent")
     * })
     */
    private $idEvent;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;
/**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Paiement", mappedBy="idRes")
     */
    private $paiements;




    private ?Paiement $paiement =null;

   
    public function __construct()
    {
        $this->paiements = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): static
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    public function getImagesrc(): ?string
    {
        return $this->imagesrc;
    }

    public function setImagesrc(?string $imagesrc): static
    {
        $this->imagesrc = $imagesrc;

        return $this;
    }

    public function getNamee(): ?string
    {
        return $this->namee;
    }

    public function setNamee(?string $namee): static
    {
        $this->namee = $namee;

        return $this;
    }

    public function getEventprice(): ?float
    {
        return $this->eventprice;
    }

    public function setEventprice(?float $eventprice): static
    {
        $this->eventprice = $eventprice;

        return $this;
    }

    public function getIdEvent(): ?Event
    {
        return $this->idEvent;
    }

    public function setIdEvent(?Event $idEvent): static
    {
        $this->idEvent = $idEvent;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

   
    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(?Paiement $paiement): void
    {
        $this->paiement = $paiement;
    }
    
    /**
     * @return Collection|Paiement[]
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }
  
}
