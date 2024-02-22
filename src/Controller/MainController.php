<?php

namespace App\Controller;

use App\Repository\TodoRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(TodoRepository $todoRepository, UserRepository $userRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'todo' => $todoRepository->findBy([]),
            'user' => $userRepository->findBy([])
        ]);
    }
}
