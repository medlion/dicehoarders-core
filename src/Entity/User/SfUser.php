<?php

namespace App\Entity\User;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table("sf_user")
 * @ORM\Entity(repositoryClass="App\Repository\SfUserRepository")
 * @Serializer\ExclusionPolicy("All")
 * @Serializer\AccessorOrder("alphabetical")
 */
class SfUser implements UserInterface
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=180, unique=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"signuprequirement", "loginresponse"})
     */
    private $email;

    /**
     * @var \DateTime
     * @ORM\Column(name="validated", type="datetime")
     * @Serializer\Expose
     * @Serializer\Groups({"loginresponse"})
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    private $validatedAt;

    /**
     * @ORM\Column(name="username", type="string", length=180, unique=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"signuprequirement", "loginresponse", "campaigndmresponse", "campaigndmresponse", "campaignadminsresponse"})
     */
    private $username;

    /**
     * @ORM\Column(name="roles", type="json")
     * @var string[]
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;

    /**
     * @var string
     */
    private $token;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return \DateTime
     */
    public function getValidatedAt(): \DateTime
    {
        return $this->validatedAt;
    }

    /**
     * @param \DateTime|null $validatedAt
     */
    public function setValidatedAt($validatedAt): void
    {
        $this->validatedAt = $validatedAt;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     */
    public function setCreatedAt(\DateTime $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     */
    public function setUpdatedAt(\DateTime $updated_at): void
    {
        $this->updated_at = $updated_at;
    }



    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {

    }

    /**
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("plaintext_password")
     * @Serializer\Expose()
     * @Serializer\Groups({"signuprequirement"})
     * @Serializer\Type("string")
     * @param string $plaintextPassword
     */
    public function setPlaintextPlassword ()
    {
    }

    /**
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("token")
     * @Serializer\Expose()
     * @Serializer\Groups({"loginresponse"})
     * @Serializer\Type("string")
     *
     * @return string
     */
    public function getToken ()
    {
        return $this->token;
    }

    /**
     * @param $token
     */
    public function setToken ($token)
    {
        $this->token = $token;
    }
}
