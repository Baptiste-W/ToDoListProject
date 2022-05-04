<?php

namespace App\Controller;

use App\Entity\Listes;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    #[Route('/list', name: 'create_list', methods: ['POST'])]
    public function create(Request $request, ManagerRegistry $registry, SessionInterface $session, UsersRepository $usersRepository): JsonResponse
    {
        if (!$request->request->get('nom')) {
            return new JsonResponse(['error' => 'Veuillez renseigner un nom'], Response::HTTP_BAD_REQUEST);
        }

        $list = new Listes();
        $list->setlistName($request->request->get('nom'));
        $list->setUsers($usersRepository->find($session->get('user')->getId()));

        $entityManager = $registry->getManager();
        $entityManager->persist($list);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Liste créee'], Response::HTTP_CREATED);
    }
}
