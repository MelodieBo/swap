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
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $users = [];
        // fixtures pour users
        for ($i=0; $i < 10; $i++) { 
            $user = new User();
            $user->setEmail('name'. $i . '@gmail.com')
                 ->setPassword($this->encoder->encodePassword($user,'toto'))
                 ->setAdresse('46, rue Pierre Motte')
                 ->setTelephone('0186224435')
                 ->setVille('SAINT-DENIS')
                 ->setCodePostale('97400');
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
            $product = new Produit();
            $product->setTitre("Titre du produit n° $i")
                    ->setDescription("Inter quos Paulus eminebat notarius ortus in Hispania, glabro quidam sub vultu latens, odorandi vias periculorum occultas perquam sagax.")
                    ->setValeur(13)
                    ->setImage('https://cdn.pixabay.com/photo/2014/05/03/00/50/video-controller-336657_1280.jpg')
                    ->setCreeLe(new \DATETIME())
                    ->setCategorie($categories[rand(0, count($categories)-1)]);
                    
            $manager->persist($product);
        }

        $manager->flush();
    }
}
