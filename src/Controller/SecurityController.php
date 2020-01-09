<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

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
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $req, UserPasswordEncoderInterface $encoder)
    {

        if ($req->isMethod('POST')) {
            $user = new User();
            $user->setEmail($req->request->get('email'));
            $user->setPassword($encoder->encodePassword($user, $req->request->get('password')));
            $user->setAdresse($req->request->get('adresse'));
            $user->setTelephone($req->request->get('telephone'));
            $user->setVille($req->request->get('ville'));
            $user->setCodePostale($req->request->get('code_postale'));
            $user->setRoles(['ROLE_USER']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('home');
            return $this->addFlash('success', 'votre insciption est bien fait, veuillez connecter au boutton login !');
        }

        return $this->render('security/register.html.twig');
    }
}
