<?php

namespace App\Entity;

use App\Repository\McqQuestionListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: McqQuestionListRepository::class)]
class McqQuestionList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $question_no = null;

    #[ORM\Column(length: 500)]
    private ?string $question = null;

    #[ORM\Column(length: 100)]
    private ?string $option1 = null;

    #[ORM\Column(length: 100)]
    private ?string $option2 = null;

    #[ORM\Column(length: 100)]
    private ?string $option3 = null;

    #[ORM\Column(length: 100)]
    private ?string $option4 = null;

    #[ORM\Column(length: 100)]
    private ?string $answer = null;

    #[ORM\Column(length: 500)]
    private ?string $exam_unique_id = null;

    #[ORM\Column(length: 500)]
    private ?string $question_unique_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionNo(): ?string
    {
        return $this->question_no;
    }

    public function setQuestionNo(string $question_no): static
    {
        $this->question_no = $question_no;

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

    public function getOption1(): ?string
    {
        return $this->option1;
    }

    public function setOption1(string $option1): static
    {
        $this->option1 = $option1;

        return $this;
    }

    public function getOption2(): ?string
    {
        return $this->option2;
    }

    public function setOption2(string $option2): static
    {
        $this->option2 = $option2;

        return $this;
    }

    public function getOption3(): ?string
    {
        return $this->option3;
    }

    public function setOption3(string $option3): static
    {
        $this->option3 = $option3;

        return $this;
    }

    public function getOption4(): ?string
    {
        return $this->option4;
    }

    public function setOption4(string $option4): static
    {
        $this->option4 = $option4;

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

    public function getExamUniqueId(): ?string {
        return $this->exam_unique_id;
    }

    public function setExamUniqueId(string $exam_unique_id): static
    {
        $this->exam_unique_id = $exam_unique_id;

        return $this;
    }

    public function getQuestionUniqueId(): ?string
    {
        return $this->question_unique_id;
    }

    public function setQuestionUniqueId(string $question_unique_id): static
    {
        $this->question_unique_id = $question_unique_id;

        return $this;
    }
}
