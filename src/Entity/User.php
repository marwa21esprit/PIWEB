<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id ;

    #[Assert\NotBlank(message: 'Le nom ne peut pas être vide')]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Le nom doit contenir au moins {{ limit }} caractères',
        maxMessage: 'Le nom ne peut pas dépasser {{ limit }} caractères'
    )]
    #[ORM\Column(length: 255)]
    private ?string $name ;

    #[Assert\NotBlank(message: 'L\'adresse e-mail ne peut pas être vide')]
    #[Assert\Email(message: 'L\'adresse e-mail "{{ value }}" n\'est pas valide')]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email ;

    #[Assert\NotBlank(message: 'L\'adresse ne peut pas être vide')]
    #[Assert\Length(
        min: 5,
        max: 255,
        minMessage: 'L\'adresse doit contenir au moins {{ limit }} caractères',
        maxMessage: 'L\'adresse ne peut pas dépasser {{ limit }} caractères'
    )]
    #[ORM\Column(length: 255)]
    private ?string $address ;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     *
     * #[Assert\Regex(
     *     pattern: "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/",
     *     message: "Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre."
     * )]
     * #[Assert\Length(
     *     min: 8,
     *     minMessage: "Le mot de passe doit contenir au moins {{ limit }} caractères."
     * )]
     */
    #[ORM\Column]
    private ?string $password ;


    #[Assert\NotBlank(message: 'La question ne peut pas être vide')]
    #[Assert\Length(
        min: 5,
        max: 255,
    )]
    #[ORM\Column(length: 255)]
    private ?string $question ;

    #[Assert\NotBlank(message: 'La réponse ne peut pas être vide')]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'La réponse doit contenir au moins {{ limit }} caractères',
        maxMessage: 'La réponse ne peut pas dépasser {{ limit }} caractères'
    )]
    #[ORM\Column(length: 255)]
    private ?string $answer ;

    #[Assert\NotBlank(message: 'Le statut ne peut pas être vide')]
    #[Assert\Choice(choices: ['active', 'inactive'], message: 'Le statut doit être "active" ou "inactive"')]
    #[ORM\Column(length: 255)]
    private ?string $status = 'active'; // Valeur par défaut "active"

    #[ORM\Column(name: "reset_code", nullable: true)]
    private ?string $resetCode = null;

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

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
