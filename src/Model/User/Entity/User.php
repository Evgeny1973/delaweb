<?php

namespace App\Model\User\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="users", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"phone"})
 * })
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", nullable=false)
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $firstName;
    
    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $lastName;
    
    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $password;
    
    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $host;
    
    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $organization;
    
    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $phone;
    
    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = [];
    
    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="date_immutable", nullable=false)
     */
    private \DateTimeImmutable $createdAt;
    
    public function __construct(
        string $firstName,
        string $lastName,
        int $phone,
        string $password,
        int $host,
        string $organization
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->password = $password;
        $this->host = $host;
        $this->organization = $organization;
        $this->createdAt = new \DateTimeImmutable('now');
    }
    
    public function edit(
        string $firstName,
        string $lastName,
        int $phone,
        int $host,
        int $organization
    ): void {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->host = $host;
        $this->organization = $organization;
    }
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    
    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
    
    /**
     * @return int
     */
    public function getHost(): int
    {
        return $this->host;
    }
    
    /**
     * @return int
     */
    public function getOrganization(): int
    {
        return $this->organization;
    }
    
    /**
     * @return string
     */
    public function getPhone(): string
    {
        return (string) $this->phone;
    }
    
    /**
     * @return string
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->phone;
    }
    
    /**
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->phone;
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
    
    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    
    /**
     * @return string|null
     */
    public function getSalt(): ?string
    {
        return null;
    }
    
    public function eraseCredentials()
    {
    }
}
