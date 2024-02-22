<?php

namespace App\Controller;

use App\Repository\TodoRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// #[Route('/profil', name: 'app_profile')]
class ProfileController extends AbstractController
{
    #[Route('/profil', name: 'app_profile')]
    public function index(TodoRepository $todoRepository, UserRepository $userRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'todo' => $todoRepository->findBy([]),
            'user' => $userRepository->findBy([])
        ]);
    }


}
