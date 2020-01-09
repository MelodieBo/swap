<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit,[
            'action' => $this->generateURL('form'),
            
        ]);
        //handle the request
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

        // to database

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
        }
        return $this->render('form/index.html.twig', [
            'produit_form' => $form->createView(),
        ]);
    }
}
