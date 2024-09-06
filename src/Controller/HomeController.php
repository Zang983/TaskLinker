<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Enum\ProjectStatus;

##Todo : Créer les routes suivantes project/ : list,create,edit,delete,detail.
##Todo : Créer les routes suivantes task/ : create,edit,delete.
##Todo : Créer les routes suivantes team/ : list/create/edit/delete/detail
##Todo : Corriger la BDD : Corriger le modèle de la DB pour prendre en compte les dernières spécifications techniques.

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProjectRepository $projectRepository): Response
    {
        // Ajoutez du code de débogage pour afficher les informations sur les classes
        $userClass = \App\Entity\User::class;
        $loadedClass = get_class(new \App\Entity\User());

        $projects = $projectRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'projects' => $projects,
        ]);
    }
}