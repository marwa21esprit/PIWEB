<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Table(name: "certificat")]
#[ORM\Entity]
class Certificat
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(name: "ID_Certificat", type: "integer", nullable: false)]
    private $idCertificat;

    #[ORM\Column(name: "Nom_Certificat", type: "string", length: 255, nullable: false)]
    private $nomCertificat;

    #[ORM\Column(name: "Domaine_Certificat", type: "string", length: 255, nullable: false)]
    private $domaineCertificat;

    #[ORM\Column(name: "Niveau", type: "string", length: 255, nullable: false)]
    private $niveau;

    #[ORM\Column(name: "Date_Obtention_Certificat", type: "date", nullable: false)]
    private $dateObtentionCertificat;

    #[ORM\ManyToOne(targetEntity: "Etablissement")]
    #[ORM\JoinColumn(name: "ID_Etablissement", referencedColumnName: "ID_Etablissement")]
    private $idEtablissement;
}
