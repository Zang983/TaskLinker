<?php

namespace App\Controller;

use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    #[Route('/task/create/{type}', name: 'create_task')]
    public function index(Request $request,string $type): Response
    {
        $form = $this->createForm(TaskType::class, null, [
            'typeOfTask' => $type
        ]);
        return $this->render('task/form.html.twig', [
            'controller_name' => 'TaskController',
            'titlePage'=>'Créer une tâche',
            'form'=>$form
        ]);
    }
}
