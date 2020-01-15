<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        try {
            $this->denyAccessUnlessGranted('ROLE_ADMIN');
        } catch (\Throwable $th) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('admin/admin.html.twig');
    }
}
