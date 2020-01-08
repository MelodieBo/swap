<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

    /**
     * @Route("/swap/creer", name="creer")
     * @Route("/swap/produit/{id}/edit", name="editer")
     */
    public function creer(Request $request, Produit $produit = null) {
        $em = $this->getDoctrine()->getManager();

        if(!$produit) {
            $produit = new Produit();
        }
        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $categories = $repo->findAll();

       
        
        $form = $this->createFormBuilder($produit)
                     ->add('titre')
                     ->add('description')
                     ->add('categorie', ChoiceType::class, [
                        new Categorie('Femme'),
                        new Categorie('Homme'),
                        new Categorie('Enfant'),
                        new Categorie('Maison'),
                        new Categorie('Media/Loisir'),
                        new Categorie('Autre'),
                    ])
                     ->add('valeur')
                     ->add('image', FileType::class)
                     ->add('ajouter', SubmitType::class)
                     ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$produit->getId()) {
                $produit->setCreeLe(new \DateTime());
            }
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('swap');
        }

        return $this->render('produit/creer.html.twig', [
            'monFormulaire' => $form->createView(),
            'edition' => ($produit->getId() !== null) ? true : false
        ]);
    }
}
