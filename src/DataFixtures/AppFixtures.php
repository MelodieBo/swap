<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\DataFixtures\AppFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        
        $faker = Factory::create('FR-fr');

        

        for ($i = 0; $i < 30; $i++) {
            $images = ['e62e8b1f2704b4ae23d8b24f39249fb6.jpeg', '3af483868dcb13edae6eb994682141fb.jpeg', '	08c41832968b8c134733ebeac8728260.jpeg'];
            $product = new Produit();
            $product->setTitre("Titre du produit n° $i")
                    ->setDescription("Inter quos Paulus eminebat notarius ortus in Hispania, glabro quidam sub vultu latens, odorandi vias periculorum occultas perquam sagax.")
                    ->setValeur($faker->randomDigitNotNull)
                    ->setImage($images[rand(0, count($images)-1)])
                    ->setCreeLe(new \DATETIME())
                    ->setCategorie($categories[rand(0, count($categories)-1)]);
                    
            $manager->persist($product);
        }

        $manager->flush();
    } 
}
