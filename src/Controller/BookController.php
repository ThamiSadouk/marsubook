<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BookController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $user = $this->getUser(); 

        $repo = $this->getDoctrine()->getRepository(Contact::class); 

        // get all the contacts from the DB
        $contacts = $repo->findAll(); 

        return $this->render('book/index.html.twig', [
            'title' => 'Hello Marsupilami !',
            'contacts' => $contacts,
            'user' => $user
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
            // if the contact doesn't exist we set a new Datetime
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

    /** 
     * @Route("/delete/{id}", name="delete_contact")
     */
    public function delete($id) 
    {
        $manager = $this->getDoctrine()->getManager();

        $contact = $manager->getRepository(Contact::class)->find($id); 

        if (!$contact) {
            throw $this->createNotFoundException(
                'Le contact n\a pas été trouvé'
            ); 
        }

        $manager->remove($contact);
        $manager->flush(); 

        return $this->redirectToRoute('home'); 
    }
}
