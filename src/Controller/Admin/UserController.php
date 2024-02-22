<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/utilisateur', name: 'admin_user_')]
class UserController extends AbstractController 
{
    #[Route('/', name: 'index')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'user' => $userRepository->findBy([])
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/user/index.html.twig', [
            'user' => $userRepository->findBy([])
        ]);
    }

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(UserRepository $userRepository): Response
    {
        //On vérifie si l'utilisateur peut éditer avec le voter
        // $this->denyAccessUnlessGranted('USER_EDIT');
        return $this->render('admin/user/index.html.twig', [
            'user' => $userRepository->findBy([])
        ]);
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(UserRepository $userRepository): Response
    {
        
        //On vérifie si l'utilisateur peut supprimer avec le voter
        // $this->denyAccessUnlessGranted('USER_DELETE');
        return $this->render('admin/user/index.html.twig', [
            'user' => $userRepository->findBy([])
        ]);
    
    }
}