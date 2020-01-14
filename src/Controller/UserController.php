<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function user()
    {
        $user = $this->getUser();
        $roles = $user->getRoles();

        if( in_array("ROLE_ADMIN", $roles) ) {
            return $this->redirectToRoute('admin');
        }

        return $this->render('user/user.html.twig');
    }
}
