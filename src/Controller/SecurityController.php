<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
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
    public function register(Request $req, User $user = null, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        if (!$user) {
            $user = new User();
        }

        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('adresse')
            ->add('telephone', TextType::class)
            ->add('ville')
            ->add('code_postale')
            ->add('isActive')
            ->add('modifier', SubmitType::class)
            ->add('inscription', SubmitType::class)
            ->getForm();

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $user->setRoles(['ROLE_USER']);
            $user->setIsActive(true);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            return $this->redirectToRoute('app_login', [
                'monFormulaire' => $form->createView(), 
                'mainNavLogin' => true, 
                'title' => 'Login'
            ]);
        }

        return $this->render('security/register.html.twig', [
            'monFormulaire' => $form->createView(), 
            'mainNavRegistration' => true, 
            'title' => 'Inscription',
            'edition' => ($user->getId() !== null) ? true : false
        ]);
    }
}
