<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Book;
use App\Entity\DVD;
use App\Entity\Author;
use App\Entity\Ebook;
use App\Entity\CD;
use App\Entity\Journal;


use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
    // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');

        // on créé 100 books
        for ($i = 0; $i < 100; $i++) {
            $book = new Book();
            $book->setTitle($faker->name);
            $book->setCote($faker->text($maxNbChars = 5));
            $book->setFormat($faker->randomElement($array = array ('de poche','grand','moyen')));
            $book->setCodeOeuvre($faker->randomNumber($nbDigits = NULL, $strict = false));
            $book->setPages($faker->numberBetween($min = 20, $max = 500));
            $manager->persist($book);
        }
        $manager->flush();

         // on créé 100 ebooks
         for ($i = 0; $i < 10; $i++) {
            $book = new EBook();
            $book->setTitle($faker->name);
            $book->setCote($faker->text($maxNbChars = 5));
            $book->setFormat($faker->randomElement($array = array ('de poche','grand','moyen')));
            $book->setCodeOeuvre($faker->randomNumber($nbDigits = NULL, $strict = false));
            $book->setPages($faker->numberBetween($min = 20, $max = 500));
            $manager->persist($book);
        }
        $manager->flush();

         // on créé 100 cd
         for ($i = 0; $i < 10; $i++) {
            $book = new CD();
            $book->setTitle($faker->name);
            $book->setCote($faker->text($maxNbChars = 5));
            $book->setFormat($faker->randomElement($array = array ('de poche','grand','moyen')));
            $book->setCodeOeuvre($faker->randomNumber($nbDigits = NULL, $strict = false));
            $book->setPlages($faker->numberBetween($min = 10, $max = 50));
            $book->setDuration($faker->numberBetween($min = 20, $max = 500));
            $manager->persist($book);
        }
        $manager->flush();

         // on créé 100 journal
         for ($i = 0; $i < 10; $i++) {
            $book = new Journal();
            $book->setTitle($faker->name);
            $book->setCote($faker->text($maxNbChars = 5));
            $book->setFormat($faker->randomElement($array = array ('de poche','grand','moyen')));
            $book->setCodeOeuvre($faker->randomNumber($nbDigits = NULL, $strict = false));
            $book->setPeriodicity($faker->numberBetween($min = 20, $max = 500));
            $book->setSubscriptionDate($faker->numberBetween($min = 20, $max = 500));
            $manager->persist($book);
        }
        $manager->flush();

         // on créé 100 DVD
        for ($i = 0; $i < 100; $i++) {
            $dvd = new DVD();
            $dvd->setTitle($faker->name);
            $dvd->setCote($faker->text($maxNbChars = 5));
            $dvd->setFormat($faker->randomElement($array = array ('audio','video','blueray')));
            $dvd->setCodeOeuvre($faker->randomNumber($nbDigits = NULL, $strict = false));
            $dvd->setDuration($faker->dateTime($max = 'now', $timezone = null));
            $manager->persist($dvd);
        }
        $manager->flush();

         // on créé 100 authors
        for ($i = 0; $i < 100; $i++) {
            $author = new Author();
            $author->setFirstName($faker->firstName($gender = 'male'|'female'));
            $author->setLastName($faker->lastName);
            $manager->persist($author);
        }
        $manager->flush();
    }
}
