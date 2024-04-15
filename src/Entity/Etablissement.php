<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Table(name: "etablissement")]
#[ORM\Entity]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "ID_Etablissement", type: "integer", nullable: false)]
    private $idEtablissement;

    #[ORM\Column(name: "img_Etablissement", type: "string", length: 255, nullable: false)]
    private $imgEtablissement;

    #[ORM\Column(name: "Nom_Etablissement", type: "string", length: 255, nullable: false)]
    private $nomEtablissement;

    #[ORM\Column(name: "Adresse_Etablissement", type: "string", length: 255, nullable: false)]
    private $adresseEtablissement;

    #[ORM\Column(name: "Type_Etablissement", type: "string", length: 255, nullable: false)]
    private $typeEtablissement;

    #[ORM\Column(name: "Tel_Etablissement", type: "integer", nullable: false)]
    private $telEtablissement;

    #[ORM\Column(name: "Directeur_Etablissement", type: "string", length: 255, nullable: false)]
    private $directeurEtablissement;

    #[ORM\Column(name: "Date_Fondation", type: "date", nullable: false)]
    private $dateFondation;
}

