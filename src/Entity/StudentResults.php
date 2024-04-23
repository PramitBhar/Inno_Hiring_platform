<?php

namespace App\Entity;

use App\Repository\StudentResultsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentResultsRepository::class)]
class StudentResults
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $examId = null;

    #[ORM\Column(length: 500)]
    private ?string $marks = null;

    #[ORM\Column(length: 500)]
    private ?string $userName = null;

    #[ORM\Column(length: 500)]
    private ?string $userId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExamId(): ?string
    {
        return $this->examId;
    }

    public function setExamId(string $examId): static
    {
        $this->examId = $examId;

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

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): static
    {
        $this->userName = $userName;

        return $this;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): static
    {
        $this->userId = $userId;

        return $this;
    }
}
