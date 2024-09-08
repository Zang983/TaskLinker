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
##Todo : Reprendre le template de base pour adapter le titre de la page (Projet pour la site des projets, le nom du projet sur la page detail etc...)

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
            'titlePage'=> 'Projets',
            'projects' => $projects,
        ]);
    }
}