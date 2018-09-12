<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR'); 

        // create 10 fake contacts
        for($i = 1; $i <= 10; $i++) 
        {
            $contact = new Contact(); 

            $contact->setFirstName($faker->firstName($gender = 'male'|'female'))
                    ->setLastName($faker->lastName)
                    ->setEmail($faker->email)
                    ->setPhone($faker->e164PhoneNumber)
                    ->setAddress($faker->address)
                    ->setCreatedAt($faker->dateTimeBetween('-6 montds'));
            
            $manager->persist($contact); 

        }

        $manager->flush();
    }
}
