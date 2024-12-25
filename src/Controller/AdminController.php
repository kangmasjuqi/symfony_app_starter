<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Admin;

class AdminController extends AbstractController
{
    private $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    // Show the login form
    #[Route('/login', name: 'app_login_form', methods: ['GET'])]
    public function showLoginForm(): Response
    {
        return $this->render('login.html.twig');
    }

    // Handle the login form submission
    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function login(Request $request, EntityManagerInterface $em): Response
    {
        $username = $request->request->get('username');
        $password = $request->request->get('password');

        // Validate input
        if (!$username || !$password) {
            $this->addFlash('error', 'Username and password are required.');
            return $this->redirectToRoute('app_login_form');
        }

        // Find the admin by username
        $admin = $em->getRepository(Admin::class)->findOneBy(['username' => $username]);

        // Validate the credentials
        if (!$admin || $admin->getPassword() !== sha1($password)) {
            $this->addFlash('error', 'Invalid credentials.');
            return $this->redirectToRoute('app_login_form');
        }

        // Check if the admin status is 'active'
        if ($admin->getStatus() !== 'active') {
            $this->addFlash('error', 'Your account is inactive. Please contact support.');
            return $this->redirectToRoute('app_login_form');
        }
                // Store session data
        $this->session->set('admin_id', $admin->getId());
        $this->session->set('username', $admin->getUsername());

        return $this->redirectToRoute('admin_dashboard');
    }

    // Handle logout
    #[Route('/logout', name: 'app_logout', methods: ['POST'])]
    public function logout(): Response
    {
        $this->session->clear();
        
        // Flash message on logout
        $this->addFlash('success', 'You have been logged out.');
        return $this->redirectToRoute('app_login_form');
    }

    // Admin dashboard
    #[Route('/dashboard', name: 'admin_dashboard', methods: ['GET'])]
    public function dashboard(): Response
    {
        // Check if the user is logged in (session exists)
        if (!$this->session->has('admin_id')) {
            $this->addFlash('error', 'You need to log in first.');
            return $this->redirectToRoute('app_login_form');
        }

        // Render the dashboard view
        return $this->render('dashboard.html.twig', [
            'username' => $this->session->get('username'),
        ]);
    }
}
