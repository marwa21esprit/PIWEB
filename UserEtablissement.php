<?php

namespace App\Entity;

use App\Repository\UserEtablissementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserEtablissementRepository::class)]
class UserEtablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(name: "id", type: "integer")]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private $user;

    #[ORM\ManyToOne(targetEntity: Etablissement::class)]
    #[ORM\JoinColumn(name:"ID_Etablissement", referencedColumnName:"ID_Etablissement")]
    private $etablissement;

    #[ORM\Column(name: "liked", type: "boolean")]
    private $liked;

    #[ORM\Column(name: "disliked", type: "boolean")]
    private $disliked;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * @param mixed $etablissement
     */
    public function setEtablissement($etablissement): void
    {
        $this->etablissement = $etablissement;
    }

    /**
     * @return mixed
     */
    public function getLiked()
    {
        return $this->liked;
    }

    /**
     * @param mixed $liked
     */
    public function setLiked($liked): void
    {
        $this->liked = $liked;
    }

    /**
     * @return mixed
     */
    public function getDisliked()
    {
        return $this->disliked;
    }

    /**
     * @param mixed $disliked
     */
    public function setDisliked($disliked): void
    {
        $this->disliked = $disliked;
    }


}
