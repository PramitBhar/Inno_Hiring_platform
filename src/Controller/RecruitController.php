<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ExamListRepository;
/**
 * This class is used for admin related services.
 */
class RecruitController extends AbstractController
{
  #[Route('/recruit')]
  public function recruit(ExamListRepository $examList, string $userId) : Response {
    $listOfExam = $examList->findAll();
    // This is contain all the exam which created by the user.
    return $this->render('recruit/recruit.html.twig', ['examList' => $listOfExam, 'userId' => $userId]);
  }
}
