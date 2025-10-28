<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\TaskList;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/task')]
final class TaskController extends AbstractController
{
    #[Route('/', name: 'app_task_index', methods: ['GET'])]
    public function index(TaskRepository $taskRepository): Response
    {
        $tasks = $taskRepository->findOrderedByStatus(); // méthode du repo corrigée

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    #[Route('/new/{listId}', name: 'app_task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, int $listId): Response
    {
        $task = new Task();

        $taskList = $entityManager->getRepository(TaskList::class)->find($listId);
        if (!$taskList) {
            throw $this->createNotFoundException('Liste non trouvée.');
        }

        $task->setTaskList($taskList);

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($task);
            $entityManager->flush();

            // ✅ Redirection logique : retour à la liste concernée
            return $this->redirectToRoute('app_task_list_show', ['id' => $listId]);
        }

        return $this->render('task/new.html.twig', [
            'task' => $task,
            'form' => $form,
            'task_list' => $taskList, // 🔑 utile pour afficher le nom dans le titre
        ]);
    }

    #[Route('/{id}', name: 'app_task_show', methods: ['GET'])]
    public function show(Task $task): Response
    {
        return $this->render('task/show.html.twig', [
            'task' => $task,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_task_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // ✅ On redirige vers la liste d’origine si possible
            if ($task->getTaskList()) {
                return $this->redirectToRoute('app_task_list_show', [
                    'id' => $task->getTaskList()->getId(),
                ]);
            }

            return $this->redirectToRoute('app_task_index');
        }

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_task_delete', methods: ['POST'])]
    public function delete(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->request->get('_token'))) {
            $taskList = $task->getTaskList();

            $entityManager->remove($task);
            $entityManager->flush();

            // ✅ Retour logique : vers la liste dont elle dépendait
            if ($taskList) {
                return $this->redirectToRoute('app_task_list_show', [
                    'id' => $taskList->getId(),
                ]);
            }
        }

        return $this->redirectToRoute('app_task_index');
    }

    #[Route('/{id}/toggle', name: 'app_task_toggle', methods: ['POST'])]
    public function toggle(Task $task, EntityManagerInterface $entityManager): Response
    {
        // ✅ Nouvelle route légère : coche/décoche la tâche
        $task->setIsDone(!$task->isDone());
        $entityManager->flush();

        if ($task->getTaskList()) {
            return $this->redirectToRoute('app_task_list_show', [
                'id' => $task->getTaskList()->getId(),
            ]);
        }

        return $this->redirectToRoute('app_task_index');
    }
}