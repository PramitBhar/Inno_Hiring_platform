<?php

namespace App\Service\AdminSideServices;

use App\Entity\McqQuestionList;
use App\Repository\ExamListRepository;
use App\Entity\ExamList;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

/**
 * This class is used to store question list into the database.
 *
 */
class EditExam {
  public string $title;
  // It is contain the title of the exam.
  public DateTime $startTime;
  // It is contain the begin time of the exam.
  public string $examLength;
  // It is contain the length of the exam.
  public string $question;
  // It is contain question.
  public string $option1;
  // It is contain first option of the question.
  public string $option2;
  // It is contain second option of the question.
  public string $option3;
  // It is contain third option of the question.
  public string $option4;
  // It is contain fourth option of the question.
  public string $answer;
  // It is contain answer of the question.
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
    $this->question = $questionListTable['questionInput'];
    $this->option1 = $questionListTable['Option1'];
    $this->option2 = $questionListTable['Option2'];
    $this->option3 = $questionListTable['Option3'];
    $this->option4 = $questionListTable['Option4'];
    $this->answer = $questionListTable['answer'];
  }

  /**
   * This function is used to edit the exam data using unique exam id ans store the changes.
   *
   * @param EntityManagerInterface $em
   * @param ExamListRepository $examList
   * @param string $id
   *  It is contain the unique exam id
   * @return void
   */
  public function editQuestionData(EntityManagerInterface $em, ExamListRepository $examList, string $id) {
    $examListEntity = $examList->findOneBySomeField($id);
    $examListEntity->setTitle($this->title);
    $examListEntity->setStart($this->startTime);
    $examListEntity->setLength($this->examLength);
    $em->flush();
  }
}
