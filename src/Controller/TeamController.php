<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TeamController extends AbstractController
{
    #[Route('/team', name: 'team')]
    public function index(UserRepository $userRepository): Response
    {
        $team = $userRepository->findAll();
        return $this->render('team/index.html.twig', [
            'controller_name' => 'TeamController',
            'titlePage' => 'Équipe',
            'team' => $team
        ]);
    }

    #[Route('/team/member/detail/{id}', name: 'detailMember')]
    public function detailMember(UserRepository $userRepository): Response
    {
        $team = $userRepository->find();
        return $this->render('team/index.html.twig', [
            'controller_name' => 'TeamController',
            'titlePage' => 'Équipe',
            'team' => $team
        ]);
    }

    #[Route('/team/member/delete/{id}', name: 'deleteMember')]
    public function deleteMember(int $id, EntityManagerInterface $entityUserManager): Response
    {
        $repository = $entityUserManager->getRepository(User::class);
        $user = $repository->find($id);
        $entityUserManager->remove($user);
        $entityUserManager->flush();
        return $this->redirectToRoute('team');
    }

}
