<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    // Users function (returning an HTML response with Bootstrap cards)
    #[Route('/users', name: 'app_users')]
    public function users(): Response
    {
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'gender' => 'male'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'gender' => 'female'],
            ['id' => 3, 'name' => 'Samuel Johnson', 'email' => 'samuel@example.com', 'gender' => 'male'],
            ['id' => 4, 'name' => 'Emily Brown', 'email' => 'emily@example.com', 'gender' => 'female'],
            ['id' => 5, 'name' => 'Michael Davis', 'email' => 'michael@example.com', 'gender' => 'male'],
        ];

        return $this->render('users.html.twig', [
            'users' => $users,
        ]);
    }
}
