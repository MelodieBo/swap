<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SwapController extends AbstractController
{
    /**
     * @Route("/swap", name="swap")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $categories  = $repo->findAll();

        return $this->render('swap/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/", name="home")
     */

    public function home()
    {

        return $this->render('swap/home.html.twig', [
            'title' => "App SwapGift",
        ]);
        
    }
}
