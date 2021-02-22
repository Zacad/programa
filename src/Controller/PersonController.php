<?php

namespace App\Controller;

use App\DTO\Person;
use App\Form\PersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    #[Route('/person', name: 'person', methods: ['GET'])]
    public function index(): Response
    {
        $person = new Person();
        $personForm = $this->createForm(PersonType::class, $person);
        return $this->render('person/add.html.twig', [
            'form' => $personForm->createView(),
        ]);
    }
}
