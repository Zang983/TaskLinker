<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

## TODO : Gérer la création/édition et suppression de projets / utilisateurs / tâches (suppression également pour ce dernier)
## TODO : Faire un dernier check pour voir si tout est OK

class ProjectController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProjectRepository $projectRepository): Response
    {
        // Ajoutez du code de débogage pour afficher les informations sur les classes
        $userClass = \App\Entity\User::class;
        $loadedClass = get_class(new \App\Entity\User());

        $projects = $projectRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'ProjectController',
            'titlePage' => 'Projets',
            'projects' => $projects,
        ]);
    }

    #[Route('/project/{id}', name: 'project_detail')]
    public function project(int $id, ProjectRepository $projectRepository): Response
    {
        $project = $projectRepository->find($id);
        $projectTeam = $project->getUsers();
        $tasks = $project->getTasks();

        $tasksByStatus = [
        ];

        foreach ($tasks as $task) {
            $tasksByStatus[$task->getStatus()->getLibelle()][] = $task;
        }
        return $this->render('project/index.html.twig', [
            'controller_name' => 'DetailProjectController',
            'project' => $project,
            'titlePage' => $project->getName(),
            'tasksByStatus' => $tasksByStatus,
            'projectTeam' => $projectTeam,
        ]);
    }

    #[Route('/project/delete/{id}', name: 'deleteProject')]
    public function deleteProject(int $id, EntityManagerInterface $entityProjectManager): Response
    {
        $repository = $entityProjectManager->getRepository(Project::class);
        $project = $repository->find($id);
        $entityProjectManager->remove($project);
        $entityProjectManager->flush();
        return $this->redirectToRoute('home');
    }
    #[Route('/project/edit/{id}', name: 'editProject')]
public function editProject(int $id,EntityManagerInterface $entityProjectManager):Response{
        $repository = $entityProjectManager->getRepository(Project::class);
        $project = $repository->find($id);

        return $this->render('project/edit.html.twig', [
            'controller_name' => 'EditProjectController',
            'titlePage' => 'Édition du projet : '.$project->getName(),
            'project' => $project,
        ]);
    }
}