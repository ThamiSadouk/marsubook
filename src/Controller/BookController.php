<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Contact::class); 

        // get all the contacts from the DB
        $contacts = $repo->findAll(); 

        return $this->render('book/index.html.twig', [
            'title' => 'Hello Marsupilami !',
            'contacts' => $contacts
        ]);
    }

     /**
     * @Route("add", name="add_contact")
     * @Route("{id}/edit", name="edit_contact")
     * Can add or edit contact infos
     */
    public function form(Contact $contact = null, Request $request, ObjectManager $manager) 
    {
        // if there is no 'id' contact, then we create a new Contact object
        if(!$contact) {
            $contact = new Contact(); 
        }

        $form = $this->createForm(ContactType::class, $contact); 
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && ($form->isValid())) 
        {   
            // if the contact already exist we don't want to set a new Datetime
            if(!$contact->getId()) {
                $contact->setCreatedAt(new \Datetime()); 
            } 

            $manager->persist($contact); 
            $manager->flush(); 

            return $this->redirectToRoute('home'); 
        } 

        return $this->render('book/add.html.twig', [
            'formContact' => $form->createView(), 
            'editMode' => $contact->getId() !== null
        ]); 
    }

}
