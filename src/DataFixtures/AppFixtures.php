<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        
        for ($i = 1; $i < 30; $i++) {
            $cat = array('femme', 'homme', 'enfant', 'maison', 'media_loisir', 'autre');
            $rand = array_rand($cat, 1);

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
