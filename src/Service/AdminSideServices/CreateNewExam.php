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
  public string $title;
  // It is contains the title of the exam.
  public DateTime $startTime;
  // It is contains the starting time of the exam.
  public string $examLength;
  // It is contain the length of the exam.
  public string $examUniqueId;
  // It is contain the unique id of the exam.
  public string $eligibleMarks;
  // It is contain the eligibily marks to give the exam.
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
