<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ExamListRepository;

class RecruitController extends AbstractController
{
  #[Route('/recruit')]
  public function recruit(ExamListRepository $examList) : Response {
    $listOfExam = $examList->findAll();
    return $this->render('recruit/recruit.html.twig', ['examList' => $listOfExam]);
  }
}
