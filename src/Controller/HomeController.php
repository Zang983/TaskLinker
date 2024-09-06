<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Enum\ProjectStatus;

##Todo : Créer les routes suivantes project/ : list,create,edit,delete,detail.
##Todo : Créer les routes suivantes task/ : create,edit,delete.
##Todo : Créer les routes suivantes team/ : list/create/edit/delete/detail
##Todo : Corriger la BDD : Corriger le modèle de la DB pour prendre en compte les dernières spécifications techniques.
class HomeController extends AbstractController
{
    #[Route('/', name: 'projets')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
