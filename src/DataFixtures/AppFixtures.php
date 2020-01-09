<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Categorie;
use App\DataFixtures\AppFixtures;
use App\Repository\CategorieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        dd($repo);
        for ($i = 0; $i < 30; $i++) {
            
            $product = new Produit();
            $product->setTitre('')
                    ->setDescription('')
                    ->setValeur('')
                    ->setUser('')
                    ->setImage('')
                    ->setCreeLe('')
                    ->setCategorie('');
        }

        $manager->flush();
    }
}
