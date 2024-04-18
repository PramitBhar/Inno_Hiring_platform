<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\UserSideServices\CreateNewUserProfile;
use App\Repository\UserProfileRepository;
use App\Repository\ExamListRepository;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends AbstractController
{
  public function student(Request $request) : Response {
    $url = $request->headers->get('referer');
    $getUserId2 = basename(parse_url($url, PHP_URL_PATH));
    return $this->render('student/student.html.twig', ['userId' => $getUserId2]);
  }
  public function profile(EntityManagerInterface $em, Request $request) : Response {
    $url = $request->headers->get('referer');
    $getUserId2 = basename(parse_url($url, PHP_URL_PATH));
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cp = new CreateNewUserProfile($_POST);
      // $cp->storeQuestionData($em);
      $getUserId = $cp->storeUserData($em);
      return $this->redirectToRoute('student', ['userId' => $getUserId2]);
    }
    return $this->render('student/student_create_profile.html.twig', ['userId' => $getUserId2]);
  }
  public function showProfileData($userId, UserProfileRepository $user, Request $request) :Response {
    $url = $request->headers->get('referer');
    $getUserId2 = basename(parse_url($url, PHP_URL_PATH));
    $userInfo = $user->findByExampleField($userId);
    $userInfo=$userInfo[0];
    return $this->render('student/student_profile.html.twig', ['userInfo' => $userInfo, 'userId' => $getUserId2]);
  }
  public function showExamList($userId, UserProfileRepository $user, Request $request, ExamListRepository $examList) :Response {
    $url = $request->headers->get('referer');
    $getUserId2 = basename(parse_url($url, PHP_URL_PATH));
    $userInfo = $user->findByExampleField($userId);
    $userMarks=$userInfo[0]->getMarks();
    $listOfExam = $examList->findAll();
    $eligibleExams = [];
    foreach ($listOfExam as $exam) {
        if ($exam->getEligibleMarks() <= $userMarks) {
            $eligibleExams[] = $exam;
        }
    }

    // Render the view with eligible exams
    return $this->render('student/exam_list.html.twig', [
        'eligibleExams' => $eligibleExams, 'userId' => $getUserId2
    ]);
    // return $this->render('student/student_eligible_exam_list.html.twig', ['userInfo' => $userInfo, 'userId' => $getUserId2]);
  }
}

