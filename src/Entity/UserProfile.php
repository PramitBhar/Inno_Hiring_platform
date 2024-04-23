<?php

namespace App\Entity;

use App\Repository\UserProfileRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserProfileRepository::class)]
class UserProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $marks = null;

    #[ORM\Column(length: 500)]
    private ?string $userUniqueId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getMarks(): ?string
    {
        return $this->marks;
    }

    public function setMarks(string $marks): static
    {
        $this->marks = $marks;

        return $this;
    }

    public function getUserUniqueId(): ?string
    {
        return $this->userUniqueId;
    }

    public function setUserUniqueId(string $userUniqueId): static
    {
        $this->userUniqueId = $userUniqueId;

        return $this;
    }
}
