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
/**
 * This class control all the services provide to the student
 */
class StudentController extends AbstractController
{
  /**
   * This function is used to load the dashboard of the student side.
   *
   * @param Request $request
   * @param string $userId
   *  This is contain the user id of the student
   * @return Response
   */
  public function student(Request $request, string $userId) : Response {
    return $this->render('student/student.html.twig', ['userId' => $userId]);
  }

  /**
   * This function is used to create the student side profile.
   *
   * @param EntityManagerInterface $em
   * @param Request $request
   * @return Response
   */
  public function profile(EntityManagerInterface $em, Request $request) : Response {
    $url = $request->headers->get('referer');
    // Fetch the url from the header.
    $getUserId2 = basename(parse_url($url, PHP_URL_PATH));
    // This is contain user id
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cp = new CreateNewUserProfile($_POST);
      // $cp->storeQuestionData($em);
      $getUserId = $cp->storeUserData($em);
      return $this->redirectToRoute('student', ['userId' => $getUserId2]);
    }
    return $this->render('student/student_create_profile.html.twig', ['userId' => $getUserId2]);
  }

  /**
   * This function is used to get all the user profile data
   *
   * @param string $userId
   *  This is contain the user id
   * @param UserProfileRepository $user
   * @param Request $request
   * @return Response
   */
  public function showProfileData(string $userId, UserProfileRepository $user, Request $request) :Response {
    $url = $request->headers->get('referer');
    $getUserId2 = basename(parse_url($url, PHP_URL_PATH));
    $userInfo = $user->findByExampleField($userId);
    $userInfo=$userInfo[0];
    return $this->render('student/student_profile.html.twig', ['userInfo' => $userInfo, 'userId' => $getUserId2]);
  }

  /**
   * This function is used to show all the exam list which meets exam eligibility citeria.
   *
   * @param string $userId
   *  This is contain user id of the user.
   * @param UserProfileRepository $user
   * @param Request $request
   * @param ExamListRepository $examList
   * @return Response
   */
  public function showExamList(string $userId, UserProfileRepository $user, Request $request, ExamListRepository $examList) :Response {
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
  }

  /**
   * This function is used to show all the appeared exam result of a student.
   *
   * @return void
   */
  public function showResult() {
    $url = $request->headers->get('referer');
    $getUserId2 = basename(parse_url($url, PHP_URL_PATH));
    $listOfAttendedExam = [];
    $examMarks = [];
    return $this->render('recruit/student_result.html.twig', ['userId' => $getUserId2,'marks' => $marks]);
  }
}

