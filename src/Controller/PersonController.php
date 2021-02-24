<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Command\SomePersonCommand;
use App\Application\CommandHandler\SomePersonCommandHandler;
use App\Domain\IllegalArgumentException;
use App\Form\PersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    #[Route('/person', name: 'person', methods: ['GET', 'POST'])]
    public function index(Request $request, SomePersonCommandHandler $personHandler): Response
    {
        $errors = [];
        $success = null;
        $person = new SomePersonCommand();
        $personForm = $this->createForm(PersonType::class, $person);

        $personForm->handleRequest($request);
        if ($personForm->isSubmitted() && $personForm->isValid()) {
            $person = $personForm->getData();

            try {
                $personHandler->executeCommand($person);
            } catch (IllegalArgumentException|\TypeError $e) {
                $errors[] = $e->getMessage();
            }

            if (count($errors) === 0) {
                $success = true;
            }
        }

        return $this->render('person/add.html.twig', [
            'form' => $personForm->createView(),
            'errors' => $errors,
            'success' => $success
        ]);
    }
}
