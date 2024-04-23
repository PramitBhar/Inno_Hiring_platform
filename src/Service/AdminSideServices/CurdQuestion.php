<?php

namespace App\Service\AdminSideServices;

use App\Entity\McqQuestionList;
use App\Entity\ExamList;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\McqQuestionListRepository;
use DateTime;

/**
 * This class is used to store question list into the database.
 *
 */
class CurdQuestion {
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
  public string $questionUniqueId;
  // It is contain unique question id.
  /**
   * Constuctor function is used to take the input of qustions as an array.
   *
   * @param Array $questionListTable
   *
   */
  public function __construct(array $questionListTable) {
    for ($i=0; $i<count($_POST); $i++) {
      $this->question = $questionListTable['questionInput'][$i];
      $this->option1 = $questionListTable['Option1'][$i];
      $this->option2 = $questionListTable['Option2'][$i];
      $this->option3 = $questionListTable['Option3'][$i];
      $this->option4 = $questionListTable['Option4'][$i];
      $this->answer = $questionListTable['answer'][$i];
      $this->questionUniqueId = uniqid();
    }
  }
  /**
   * This function is used to store the exam question data into the database.
   *
   * @param EntityManagerInterface $em
   * @param string $examUniqueId
   * @return void
   */
  public function storeQuestionData(EntityManagerInterface $em, string $examUniqueId) {
    $questionListEntity = new McqQuestionList();
    $questionListEntity->setQuestion($this->question);
    $questionListEntity->setQuestionNo("5");
    $questionListEntity->setOption1($this->option1);
    $questionListEntity->setOption2($this->option2);
    $questionListEntity->setOption3($this->option3);
    $questionListEntity->setOption4($this->option4);
    $questionListEntity->setAnswer($this->answer);
    $questionListEntity->setExamUniqueId($examUniqueId);
    $questionListEntity->setQuestionUniqueId($this->questionUniqueId);
    $em->persist($questionListEntity);
    $em->flush();
  }

  /**
   * This function is used to fetch the questio during edit a exam.
   *
   * @param string $examId
   *  It is contain the exam id of a exam
   *
   * @param EntityManagerInterface $em
   *
   * @param McqQuestionListRepository $mcqQuestionRepo
   *
   * @return array $questionListEntity
   *  It is contain all the question of a specific exam id.
   */
  public function fetchQuestion(string $examId, EntityManagerInterface $em, McqQuestionListRepository $mcqQuestionRepo) {
    $questionListEntity = $mcqQuestionRepo->findOneBySomeField($examId);
    return $questionListEntity;
  }
}
