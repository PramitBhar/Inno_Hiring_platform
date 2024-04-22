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
  public string $firstName;
  // This variable is used to store the first name of the student.
  public string $lastName;
  // This variable is used to store the last name of the student.
  public string $marks;
  // This variable is used to store the marks of the student.
  public string $userUniqueId;
  // This variable is used to store the user unique id.
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
    $this->userUniqueId = $questionListTable['userUniqueId'];
  }
  /**
   * This function is used to store the exam data into the database.
   *
   * @param EntityManagerInterface $em
   * @return stirng $userUniqueId
   *  return the unique user id.
   */
  public function storeUserData(EntityManagerInterface $em) {
    $questionUniqueId = uniqid();
    $questionListEntity = new UserProfile();
    $questionListEntity->setFirstName($this->firstName);
    $questionListEntity->setLastName($this->lastName);
    $questionListEntity->setMarks($this->marks);
    $questionListEntity->setUserUniqueId($this->userUniqueId);
    $em->persist($questionListEntity);
    $em->flush();
    return $this->userUniqueId;
  }
}
