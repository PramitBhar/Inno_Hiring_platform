<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\UserProfileRepository;

/**
 * This class is used to login related services.
 */
class LoginController extends AbstractController
{
  /**
   * This function help us to login and redirect.
   * At first this function loads the login page based on user type it redirect
   * the route and send the userId alongwith.
   *
   * @param AuthenticationUtils $authentication
   *  This param help us to check authentication of the user.
   *
   * @return
   */
  #[Route(path: '/login', name: 'app_login')]
  public function login(AuthenticationUtils $authenticationUtils, UserProfileRepository $profile): Response
  {
    if ($this->getUser()) {
      $repo = $this->getUser();
      $getuserId = $repo->getId();
      if ($repo->getUserType() == 'admin') {
        return $this->redirectToRoute('recruit', ['userId' => $getuserId]);
      }
      else {
        $oldUser = $profile->findByExampleField($getuserId);
        if ($oldUser == NULL) {
          return $this->redirectToRoute('student_profile', ['userId' => $getuserId]);
        }
        else {
          return $this->redirectToRoute('student', ['userId' => $getuserId]);
        }
      }
    }
      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();
      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
  }

  /**
   * This is used for user logout.
   *
   * @return void
   */
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
