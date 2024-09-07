<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    #[Route('/project/{id}', name: 'project_detail')]
    public function index(int $id, ProjectRepository $projectRepository): Response
    {
        $project = $projectRepository->find($id);
        $tasks = $project->getTasks();

        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'project' => $project,
        ]);
    }
}
