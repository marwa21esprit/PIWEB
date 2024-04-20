<?php
namespace App\Entity;


use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id ;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null ;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $lastlogin = null;

    #[ORM\Column]
    private ?string $password ;

    #[ORM\Column(length: 255)]
    private ?string $question ;

    #[ORM\Column(length: 255)]
    private ?string $answer ;

    #[ORM\Column(length: 255)]
    private ?string $status = 'active'; // Valeur par défaut "active"

    #[ORM\Column(name: "reset_code", nullable: true)]
    private ?string $resetCode = null;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: UserEtablissement::class)]
    private $userEtablissements;


    public function __construct()
    {
        $this->question = '';
        $this->answer = '';
        $this->userEtablissements = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastlogin(): ?\DateTimeInterface
    {
        return $this->lastlogin;
    }

    /**
     * @param \DateTimeInterface|null $lastlogin
     */
    public function setLastlogin(?\DateTimeInterface $lastlogin): void
    {
        $this->lastlogin = $lastlogin;
    }

    /**
     */
    private ?string $confirmPassword = null;

    /**
     * @return string|null
     */
    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    /**
     * @param string|null $confirmPassword
     */
    public function setConfirmPassword(?string $confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }

    /**
     * @return string|null
     */
    public function getResetCode(): ?string
    {
        return $this->resetCode;
    }

    /**
     * @param string|null $resetCode
     */
    public function setResetCode(?string $resetCode): void
    {
        $this->resetCode = $resetCode;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): static
    {
        $this->question = $question;
=======
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

    public function setAnswer(?string $answer): static
    {
        $this->answer = $answer;

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
