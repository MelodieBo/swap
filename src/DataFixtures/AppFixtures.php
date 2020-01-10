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

        dd($repo);
        for ($i = 0; $i < 30; $i++) {
            
            $product = new Produit();
            $product->setTitre('Lorem ipsum dolor sit amet')
                    ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. In iaculis lacus non lacus pharetra iaculis. Praesent dui quam, molestie a porta ut, fringilla quis neque. Vivamus vestibulum lectus laoreet ex condimentum ultricies. Fusce luctus elit sed eleifend feugiat. Nullam eu felis eget neque porttitor pellentesque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec blandit nunc in maximus fringilla. Maecenas quis massa dictum, varius enim fermentum, placerat enim.')
                    ->setValeur('')
                    ->setUser('')
                    ->setImage('https://cdn.pixabay.com/photo/2014/05/03/00/50/video-controller-336657_1280.jpg')
                    ->setCreeLe(new \DATETIME())
                    ->setCategorie('');
        }

        $manager->flush();
    }
}
