<?php

namespace App\Controller;

use App\Entity\Listes;
use App\Entity\Taches;
use App\Repository\ListesRepository;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class TaskController extends AbstractController
{
    /**
     * @Route("/taches/{id}", name="task_delete", methods={"DELETE"})
     */
    public function delete(Taches $taches, ManagerRegistry $registry)
    {
        $entityManager = $registry->getManager();
        $entityManager->remove($taches);
        $entityManager->flush();

        return new JsonResponse('ok', 200);
    }

    /**
     * @Route("/taches", name="create_task", methods={"POST"})
     */
    public function create(Request $request, ManagerRegistry $registry, ListesRepository $listesRepository,  SessionInterface $session, UsersRepository $usersRepository): JsonResponse
    {
        if (!$request->request->get('taskName')) {
            return new JsonResponse(['error' => 'Veuillez renseigner un nom'], Response::HTTP_BAD_REQUEST);
        }

        $task = new Taches();
        $task->setTaskName($request->request->get('taskName'));
        $task->setTaskPriority($request->request->get('taskPriority'));
        $task->setListes($listesRepository->find($request->request->get('listId')));

        $entityManager = $registry->getManager();
        $entityManager->persist($task);
        $entityManager->flush();

        return new JsonResponse(['message' => 'Tache crée'], Response::HTTP_CREATED);
    }
}
