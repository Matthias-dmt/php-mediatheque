<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Book;
use App\Entity\DVD;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
    // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 10 books
        for ($i = 0; $i < 10; $i++) {
            $book = new Book();
            $book->setTitle($faker->name);
            $book->setCote($faker->text($maxNbChars = 5));
            $book->setFormat($faker->randomElement($array = array ('de poche','grand','moyen')));
            $book->setCodeOeuvre($faker->randomNumber($nbDigits = NULL, $strict = false));
            $book->setPages($faker->numberBetween($min = 20, $max = 500));
            $manager->persist($book);
        }
        $manager->flush();

        for ($i = 0; $i < 10; $i++) {
            $dvd = new DVD();
            $dvd->setTitle($faker->name);
            $dvd->setCote($faker->text($maxNbChars = 5));
            $dvd->setFormat($faker->randomElement($array = array ('audio','video','blueray')));
            $dvd->setCodeOeuvre($faker->randomNumber($nbDigits = NULL, $strict = false));
            $dvd->setDuration($faker->time($format = 'H:i:s', $max = 'now'));
            $manager->persist($dvd);
        }
        $manager->flush();
    }
}
