<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR'); 

        // create 5 fake users 
        for($i = 1; $i <= 3; $i++) 
        {
            $user = new User();
            
            $user->setUsername($faker->firstName($gender = 'male'|'female'))
                 ->setEmail($faker->email)
                 ->setPassword('testtest')
                 ->setAge(43)
                 ->setFamily($faker->lastName)
                 ->setRace('jaune')
                 ->setFood($faker->word); 

            $manager->persist($user); 

            // create 10 fake contacts
            for($j = 1; $j <= 10; $j++) 
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
        }

        $manager->flush();
    }
}
