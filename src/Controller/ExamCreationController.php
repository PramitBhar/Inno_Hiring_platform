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

class ExamCreationController extends AbstractController
{
  // #[Route('/recruit/new-test')]
  public $getExamId;
  public function createExam(EntityManagerInterface $em) : Response
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $cp = new CreateNewExam($_POST);
      // $cp->storeQuestionData($em);
      $getExamId = $cp->storeExamData($em);
      return $this->redirectToRoute('add_question', ['getExamId' => $getExamId]);
    }
    return $this->render('recruit/new_exam.html.twig');
  }
  public function addQuestion(EntityManagerInterface $em, Request $request) : Response
  {
    $url = $request->headers->get('referer');
    $getExamId = basename(parse_url($url, PHP_URL_PATH));
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $cp = new CurdQuestion($_POST);
      // $getExamId = $this->getExamId;
      $cp->storeQuestionData($em, $getExamId);
      // $getExamId = $cp->storeExamData($em);
      return $this->redirectToRoute('add_question', ['getExamId' => $getExamId]);
    }
    return $this->render('recruit/add_exam.html.twig', ['getExamId' => $getExamId]);
  }
  public function editExam(EntityManagerInterface $em, ExamListRepository $examList, McqQuestionListRepository $mcqQuestionList, Request $request) : Response  {
    $queryParameter = $request->query->get('q');
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
      $editOperation = new EditExam($_POST);
      $editOperation->editQuestionData($em, $examList, $queryParameter);
      return $this->redirectToRoute('recruit');
    }
    $examInformation = $examList->find($queryParameter);
    return $this->render('recruit/edit_exam.html.twig', ['examInfo' => $examInformation]);
  }
  /**
   *
   */
  public function submitExam(EntityManagerInterface $em, ExamListRepository $examList, McqQuestionListRepository $mcqQuestionList, Request $request, SessionInterface $session) : Response  {

    $url = $request->getUri();
    $getExamId = basename(parse_url($url, PHP_URL_PATH));
    $examInformation = $examList->findOneBySomeField($getExamId);
    $questionData = $mcqQuestionList->findOneBySomeField($getExamId);
    $calc = 0;
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
      $url = $request->headers->get('referer');
      $getExamId2 = basename(parse_url($url, PHP_URL_PATH));
      $examData = $request->request->all();
      foreach ($examData as $questionUniqueId => $answer) {
        // $session->set($questionUniqueId, $answer);
        $ans = $mcqQuestionList->getAns($questionUniqueId);
        $correctAnswer = $ans['0']->getAnswer();
        if ($correctAnswer == $answer) {
           $calc+=5;
        }
        echo $calc;
      }
      return $this->redirectToRoute('result', ['marks' => $calc, 'getExamId' => $getExamId2]);
    }
    return $this->render('recruit/exam_submission.html.twig', ['examInfo'=> $examInformation,'mcq' => $questionData]);
  }
  public function examResult(EntityManagerInterface $em, ExamListRepository $examList, McqQuestionListRepository $mcqQuestionList, Request $request, SessionInterface $session) : Response  {
    $url = $request->headers->get('referer');
    $getExamId = basename(parse_url($url, PHP_URL_PATH));
    $marks = 0 | $request->query->get('marks');
    return $this->render('recruit/exam_result.html.twig', ['getExamId' => $getExamId,'marks' => $marks]);
  }
}
