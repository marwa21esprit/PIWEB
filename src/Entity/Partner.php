<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Table(name: "partner")]
#[ORM\Entity]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "idPartner", type: "integer", nullable: false)]
    private $idpartner;

    #[ORM\Column(name: "namePartner", type: "string", length: 100, nullable: false)]
    private $namepartner;

    #[ORM\Column(name: "typePartner", type: "string", length: 100, nullable: false)]
    private $typepartner;

    #[ORM\Column(name: "description", type: "string", length: 100, nullable: false)]
    private $description;

    #[ORM\Column(name: "email", type: "string", length: 100, nullable: false)]
    private $email;

    #[ORM\Column(name: "tel", type: "integer", nullable: false)]
    private $tel;

    #[ORM\Column(name: "image", type: "string", length: 1000, nullable: false)]
    private $image;
}
