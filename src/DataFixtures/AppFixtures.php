<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\DataFixtures\AppFixtures;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture

{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $users = [];
        // fixtures pour users
        $faker = \Faker\Factory::create('fr_FR');
        for ($i=0; $i < 10; $i++) { 
            $user = new User();
            $user->setEmail($faker->email())
                 ->setPassword($faker->password($this->encoder->encodePassword($user,'toto')))
                 ->setAdresse($faker->address)
                 ->setTelephone($faker->phoneNumber)
                 ->setVille($faker->country)
                 ->setCodePostale($faker->postcode);
            $manager->persist($user);
            
            $users[] = $user;
        }
        $manager->flush();
        //dd($user);
        $categories = [
            (new Categorie())->setLibelle('femme'),
            (new Categorie())->setLibelle('homme'),
            (new Categorie())->setLibelle('enfant'),
            (new Categorie())->setLibelle('maison'),
            (new Categorie())->setLibelle('media'),
            (new Categorie())->setLibelle('autre'),
        ];

        for ($i=0; $i < count($categories); $i++) { 
            $manager->persist($categories[$i]);
        }
        $manager->flush();
        

        for ($i = 0; $i < 30; $i++) {
            $categorie = $categories[(mt_srand(0,5))];
            $user = $users[(mt_srand(0, 9))];
            $product = new Produit();
            $product->setTitre($faker->realText())
                    ->setDescription($faker->sentence())
                    ->setValeur(13)
                    ->setUser($user)
                    ->setImage('https://cdn.pixabay.com/photo/2014/05/03/00/50/video-controller-336657_1280.jpg')
                    ->setCreeLe(new \DATETIME())
                    ->setCategorie($categorie);
                    
            $manager->persist($product);
        }

        $manager->flush();
    }
}
