<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager, CategorieRepository $repo)
    {
        
        for ($i = 1; $i < 30; $i++) {

            $rand = array_rand($repo, 1);

            $produit = new Produit;
            $produit->setCategorie($rand)
                    ->setUser()
                    ->setTitre("Cadeau n° $i")
                    ->setDescription("Descrpition optionnelle du cadeau n° $i")
                    ->setValeur("Prix du cadeau n° $i" . mt_rand(10, 100));

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
