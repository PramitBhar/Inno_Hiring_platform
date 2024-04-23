<?php

namespace App\Service\UserSideServices;

use App\Entity\McqQuestionList;
use App\Entity\ExamList;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\McqQuestionListRepository;
use App\Entity\StudentResults;
use App\Repository\UserProfileRepository;

/**
 * This class is used to store user result into the database.
 *
 */
class GenerateResult {
  /**
   * This function is used to store the user exam performance data into the database.
   *
   * @param string $userId
   *  This variable contains the registered id of user
   *
   * @param string $examId
   *  This variable contains the id of the exam whose result will be shown.
   *
   * @param string $fullName
   *  This variable contains the user name of the user.
   *
   * @param string $marks
   *  This variable the contains the marks of the user.
   *
   * @param EntityManagerInterface $em
   *  This
   */
  public function storeStudentPerformanceData(string $userId, string $examId, string $fullName, string $marks, EntityManagerInterface $em) {
    $questionListEntity = new StudentResults();
    $questionListEntity->setUserName($fullName);
    $questionListEntity->setUserId($userId);
    $questionListEntity->setExamId($examId);
    $questionListEntity->setMarks($marks);
    $em->persist($questionListEntity);
    $em->flush();
  }
}
