<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
  /**
   * This function is used for user registration
   *
   * @param Request $request
   * @param UserPasswordHasherInterface $userPasswordHasher
   * @param EntityManagerInterface $entityManager
   * @return Response
   */
  #[Route('/register', name: 'app_register')]
  public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
  {
      $user = new User();
      $form = $this->createForm(RegistrationFormType::class, $user);
      $form->handleRequest($request);
      // if form is valid and submitter then we push the user in the database.
      if ($form->isSubmitted() && $form->isValid()) {
          // encode the plain password
          $user->setPassword(
              $userPasswordHasher->hashPassword(
                  $user,
                  $form->get('plainPassword')->getData()
              )
          );

          $entityManager->persist($user);
          $entityManager->flush();
          // After successful registration redirect to login page.
          return $this->redirectToRoute('app_login');
      }
      return $this->render('registration/register.html.twig', [
          'registrationForm' => $form,
      ]);
  }
}
