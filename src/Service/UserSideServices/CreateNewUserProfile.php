<?php

namespace App\Service\UserSideServices;

use App\Entity\McqQuestionList;
use App\Entity\ExamList;
use App\Entity\UserProfile;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

/**
 * This class is used to store question list into the database.
 *
 */
class CreateNewUserProfile {
  /**
   * Constuctor function is used to take the input of qustions as an array.
   *
   * @param Array $questionListTable
   *
   */
  public function __construct(array $questionListTable) {
    $this->firstName = $questionListTable['fname'];
    $this->lastName = $questionListTable['lname'];
    $this->marks = $questionListTable['marks'];
    // $this->question = $questionListTable['questionInput'];
    // $this->option1 = $questionListTable['Option1'];
    // $this->option2 = $questionListTable['Option2'];
    // $this->option3 = $questionListTable['Option3'];
    // $this->option4 = $questionListTable['Option4'];
    // $this->answer = $questionListTable['answer'];
    $this->userUniqueId = $questionListTable['userUniqueId'];
    // $this->questionUniqueId = uniqid();
  }
  /**
   * This function is used to store the exam data into the database.
   */
  public function storeUserData(EntityManagerInterface $em) {
    $questionUniqueId = uniqid();
    $questionListEntity = new UserProfile();
    $questionListEntity->setFirstName($this->firstName);
    // $questionListEntity->setQuestionNo("5");
    $questionListEntity->setLastName($this->lastName);
    $questionListEntity->setMarks($this->marks);
    // $questionListEntity->setOption3($this->option3);
    // $questionListEntity->setOption4($this->option4);
    // $questionListEntity->setAnswer($this->answer);
    $questionListEntity->setUserUniqueId($this->userUniqueId);
    // $questionListEntity->setQuestionUniqueId($questionUniqueId);
    $em->persist($questionListEntity);
    $em->flush();
    return $this->userUniqueId;
  }
  public function storeExamData(EntityManagerInterface $em) {
    $examListEntity = new ExamList();
    $examListEntity->setTitle($this->title);
    $examListEntity->setStart($this->startTime);
    $examListEntity->setLength($this->examLength);
    $examListEntity->setExamUniqueId($this->examUniqueId);
    $em->persist($examListEntity);
    $em->flush();
    return $this->examUniqueId;
  }
}
