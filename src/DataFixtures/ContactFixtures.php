<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++) 
        {
            $contact = new Contact(); 

            $contact->setFirstName('zdlfkjdf')
                    ->setLastName('dfklhdf')
                    ->setEmail('thami.sadouk@outlok.dr')
                    ->setPhone('239249')
                    ->setAddress('ùlkfhd')
                    ->setCreatedAt(new \DateTime());
            
            $manager->persist($contact); 

        }

        $manager->flush();
    }
}
