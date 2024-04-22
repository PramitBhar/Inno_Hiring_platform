<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\AdminSideServices\CreateNewExam;
use App\Service\AdminSideServices\CurdQuestion;
use App\Service\AdminSideServices\EditExam;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ExamListRepository;
use App\Repository\McqQuestionListRepository;
use App\Repository\StudentResultsRepository;
use App\Repository\UserProfileRepository;
use App\Service\UserSideServices\GenerateResult;

/**
 * This class is used for exam related routes.
 */
class ExamCreationController extends AbstractController
{
  public $getExamId;
  // This is used to get the exam id.
  /**
   * This function is used to create a new exam.
   *
   * @param EntityManagerInterface $em
   * @return Response
   */
  public function createExam(EntityManagerInterface $em) : Response
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $cp = new CreateNewExam($_POST);
      $getExamId = $cp->storeExamData($em);
      return $this->redirectToRoute('add_question', ['getExamId' => $getExamId]);
    }
    return $this->render('recruit/new_exam.html.twig');
  }

  /**
   * This function is used to add question in a new exam.
   *
   * @param EntityManagerInterface $em
   * @param Request $request
   * @return Response
   */
  public function addQuestion(EntityManagerInterface $em, Request $request) : Response
  {
    $url = $request->headers->get('referer');
    // This variable is fetch the url from the header.
    $getExamId = basename(parse_url($url, PHP_URL_PATH));
    // It is contain the exam id from the header
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $cp = new CurdQuestion($_POST);
      $cp->storeQuestionData($em, $getExamId);
      return $this->redirectToRoute('add_question', ['getExamId' => $getExamId]);
    }
    return $this->render('recruit/add_exam.html.twig', ['getExamId' => $getExamId]);
  }

  /**
   * This function is used to edit exam details.
   * Using this fuction at first fetch the exam id from the header.After that
   * fetch exam details of that particular id and update the details.
   *
   * @param EntityManagerInterface $em
   * @param ExamListRepository $examList
   *  It is used to call exam related method which fetch exam data.
   * @param McqQuestionListRepository $mcqQuestionList
   *  It is used to call mcq question related method which fetch question data.
   * @param Request $request
   *  Request represent an http request.
   * @return Response
   */
  public function editExam(EntityManagerInterface $em, ExamListRepository $examList, McqQuestionListRepository $mcqQuestionList, Request $request) : Response {
    // $queryParameter = $request->query->get('q');
    $url = $request->getUri();
    $query = explode('/', parse_url($url, PHP_URL_PATH));
    $queryParameter = $query[4];
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
      $editOperation = new EditExam($_POST);
      $editOperation->editQuestionData($em, $examList, $queryParameter);
      return $this->redirectToRoute('recruit', ['userId' => $query[3]]);
    }
    $examInformation = $examList->findOneBySomeField($queryParameter);
    return $this->render('recruit/edit_exam.html.twig', ['examInfo' => $examInformation]);
  }
  /**
   * This function is used to takes data from user answer and calculate the marks.
   *
   * @param EntityManagerInterface $em
   * @param ExamListRepository $examList
   * @param McqQuestionListRepository $mcqQuestionList
   * @param Request $request
   * @param UserProfileRepository $userDetails
   * @return Response
   */
  public function submitExam(EntityManagerInterface $em, ExamListRepository $examList, McqQuestionListRepository $mcqQuestionList, Request $request, UserProfileRepository $userDetails) : Response  {
    $url = $request->getUri();
    $getExamId = basename(parse_url($url, PHP_URL_PATH));
    $examInformation = $examList->findOneBySomeField($getExamId);
    $questionData = $mcqQuestionList->findOneBySomeField($getExamId);
    $calc = 0;
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
      $url = $request->headers->get('referer');
      $path = explode('/', parse_url($url, PHP_URL_PATH));
      $getUserId = $path[2];
      $getExamId2 = $path[3];
      $examData = $request->request->all();
      foreach ($examData as $questionUniqueId => $answer) {
        $ans = $mcqQuestionList->getAns($questionUniqueId);
        $correctAnswer = $ans['0']->getAnswer();
        if ($correctAnswer == $answer) {
          $calc+=5;
        }
      }
      $UserResult = new GenerateResult();
      $userName = $userDetails->findByExampleField($getUserId);
      $firstName = $userName['0']->getFirstName();
      $lastName = $userName['0']->getLastName();
      $fullName = $firstName." ".$lastName;
      $UserResult->storeStudentPerformanceData($getUserId, $getExamId2, $fullName, $calc, $em);

      return $this->render('recruit/exam_result.html.twig', ['getExamId' => $getExamId2, 'marks' => $calc]);
    }

    return $this->render('recruit/exam_submission.html.twig', ['examInfo'=> $examInformation,'mcq' => $questionData]);
  }
  /**
   * This function is used to see the current exam score after submitting the exam.
   *
   * @param EntityManagerInterface $em
   * @param ExamListRepository $examList
   * @param McqQuestionListRepository $mcqQuestionList
   * @param Request $request
   * @param string $marks
   *  This is contain the marks of the user
   * @param string $getExamId
   *  This is contain the exam id of the exam
   * @return Response
   */
  public function examResult(EntityManagerInterface $em, ExamListRepository $examList, McqQuestionListRepository $mcqQuestionList, Request $request, string $marks, string $getExamId) : Response  {
    $url = $request->headers->get('referer');
    // $getExamId = basename(parse_url($url, PHP_URL_PATH));
    // $marks = 0 | $request->query->get('marks');
    return $this->render('recruit/exam_result.html.twig', ['getExamId' => $getExamId,'marks' => $marks]);
  }
}
