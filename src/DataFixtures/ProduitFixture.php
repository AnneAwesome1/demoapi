<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Produits;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i=0; $i<10; $i++) {
            $produit = new Produits();
            $produit->setNom($faker->sentence(1));
            $produit->setDescription($faker->sentence(15));
            $produit->setPrix($faker->randomFloat(2, 1, 100));
            $manager->persist($produit);
        }
        $manager->flush();
    }
}
