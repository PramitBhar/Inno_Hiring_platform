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
  public function editQuestionData(EntityManagerInterface $em, ExamListRepository $examList, int $id) {
    $examListEntity = $examList->find($id);
    $examListEntity->setTitle($this->title);
    $examListEntity->setStart($this->startTime);
    $examListEntity->setLength($this->examLength);
    $em->flush();
  }
}
