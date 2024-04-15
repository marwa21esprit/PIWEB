<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Table(name: "user")]
#[ORM\Entity]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "id", type: "integer", nullable: false)]
    private $id;

    #[ORM\Column(name: "role", type: "string", length: 100, nullable: false)]
    private $role;

    #[ORM\Column(name: "name", type: "string", length: 100, nullable: false)]
    private $name;

    #[ORM\Column(name: "email", type: "string", length: 100, nullable: false)]
    private $email;

    #[ORM\Column(name: "password", type: "string", length: 100, nullable: false)]
    private $password;

    #[ORM\Column(name: "address", type: "string", length: 100, nullable: false)]
    private $address;

    #[ORM\Column(name: "question", type: "string", length: 100, nullable: false)]
    private $question;

    #[ORM\Column(name: "answer", type: "string", length: 100, nullable: false)]
    private $answer;

    #[ORM\Column(name: "Status", type: "string", length: 100, nullable: false)]
    private $status;
}
