<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Project;

class HelloWorldController extends AbstractController
{
    #[Route('/hello', name: 'app_hello_world')]
    public function index(): Response
    {
        return new Response('Hello World!');
    }

    // Greet function
    #[Route('/greet/{name}', name: 'app_greet')]
    public function greet(string $name): Response
    {
        return $this->render('hello_world/greet.html.twig', [
            'name' => $name
        ]);
    }
}