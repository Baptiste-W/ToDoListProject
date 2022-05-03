<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(Request $request, UsersRepository $usersRepository, SessionInterface $session): Response
    {
        if ($session->get('user') != null) {
            return $this->redirectToRoute('dashboard');
        }

        if($request->isMethod('post')) {
            $mail = $request->get('mail');
            $password = $request->get('mdp');

            $user = $usersRepository->findOneBy(['email' => $mail, 'MDP' => $password]);

            if ($user != null) {
                $session->set('user', $user);

                return $this->redirectToRoute("dashboard");
            }
        }
        return $this->render('users/login.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(SessionInterface $session): Response
    {
        $session->clear();

        return $this->redirectToRoute('login');
    }
}
