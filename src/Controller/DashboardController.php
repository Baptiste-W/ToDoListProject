<?php

namespace App\Controller;

use App\Repository\ListesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */

    public function index(SessionInterface $session, ListesRepository  $listesRepository): Response
    {
        if (!$session->get('user')) {
            return $this->redirectToRoute('login');
        }

        $listes = $listesRepository->findBy(['user' => $session->get('user')]);

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'listes' => $listes
        ]);
    }
}
