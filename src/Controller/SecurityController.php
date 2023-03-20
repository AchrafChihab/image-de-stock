<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            $user_role=$this->getUser()->getRoles();
            // dd($user_role[1]);
            switch ($user_role[1]) {
                case 'ROLE_ADMIN':
                    return $this->redirectToRoute('admin_home');
                    # code...
                    break;
                case 'ROLE_CLIENT':
                    return $this->redirectToRoute('client_home');
                    # code...
                    break;
                case 'ROLE_FOURNISSEUR':
                    return $this->redirectToRoute('fournisseur_home');
                    # code...
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
