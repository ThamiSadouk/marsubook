<?php

namespace App\Controller;

use App\Entity\Contact;
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
}
