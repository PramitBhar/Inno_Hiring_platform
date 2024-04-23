<?php

namespace App\Entity;

use App\Repository\ExamListRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExamListRepository::class)]
class ExamList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(length: 100)]
    private ?string $length = null;

    #[ORM\Column(length: 500)]
    private ?string $examUniqueId = null;

    #[ORM\Column(length: 500)]
    private ?string $eligibleMarks = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(string $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function getExamUniqueId(): ?string
    {
        return $this->examUniqueId;
    }

    public function setExamUniqueId(string $examUniqueId): static
    {
        $this->examUniqueId = $examUniqueId;

        return $this;
    }

    public function getEligibleMarks(): ?string
    {
        return $this->eligibleMarks;
    }

    public function setEligibleMarks(string $eligibleMarks): static
    {
        $this->eligibleMarks = $eligibleMarks;

        return $this;
    }
}
