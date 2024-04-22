<?php

namespace App\Service\AdminSideServices;

use App\Entity\McqQuestionList;
use App\Entity\ExamList;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

/**
 * This class is used to store question list into the database.
 *
 */
class CreateNewExam {
  /**
   * Constuctor function is used to take the input of qustions as an array.
   *
   * @param Array $questionListTable
   *
   */
  public function __construct(array $questionListTable) {
    $this->title = $questionListTable['examTitle'];
    $this->startTime = new DateTime($questionListTable['startTime']);
    $this->examLength = $questionListTable['examLength'];
    $this->examUniqueId = uniqid();
    $this->eligibleMarks = $questionListTable['eligibleMarks'];
  }

  /**
   * This function is used to store the exam question data into the database.
   *
   * @param EntityManagerInterface $em
   * @param integer $examUniqueId
   *  It is contain the unique exam id for each exam.
   * @return void
   */
  public function storeQuestionData(EntityManagerInterface $em, int $examUniqueId) {
    $questionUniqueId = uniqid();
    $questionListEntity = new McqQuestionList();
    $questionListEntity->setQuestion($this->question);
    $questionListEntity->setQuestionNo("5");
    $questionListEntity->setOption1($this->option1);
    $questionListEntity->setOption2($this->option2);
    $questionListEntity->setOption3($this->option3);
    $questionListEntity->setOption4($this->option4);
    $questionListEntity->setAnswer($this->answer);
    $questionListEntity->setExamUniqueId($examUniqueId);
    $questionListEntity->setQuestionUniqueId($questionUniqueId);
    $em->persist($questionListEntity);
    $em->flush();
  }

  /**
   * This is function is used to store exam data into database.
   *
   * @param EntityManagerInterface $em
   * @return string $examUniqueId.
   *  It is contain unique exam id.
   */
  public function storeExamData(EntityManagerInterface $em) {
    $examListEntity = new ExamList();
    $examListEntity->setTitle($this->title);
    $examListEntity->setStart($this->startTime);
    $examListEntity->setLength($this->examLength);
    $examListEntity->setEligibleMarks($this->eligibleMarks);
    $examListEntity->setExamUniqueId($this->examUniqueId);
    $em->persist($examListEntity);
    $em->flush();
    return $this->examUniqueId;
  }
}
