<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Entity\User;
use App\Repository\TodoRepository;
use App\Repository\UserRepository;
use App\Form\TodoFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/todo', name: 'todo_')]
class TodoController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(TodoRepository $todoRepository, UserRepository $userRepository): Response
    {
        return $this->render('todo/index.html.twig', [
            'todo' => $todoRepository->findBy([]),
            'user' => $userRepository->findBy([])
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        // On crée une nouvelle tâche
        $todo = new Todo();
        
        // On crée le formulaire
        $todoForm = $this->createForm(TodoFormType::class, $todo);

        // On traite la requête du formulaire
        $todoForm->handleRequest($request);

            // dd($todo);
        
        // On vérifie si le formulaire est soumis et valide
        if($todoForm->isSubmitted() && $todoForm->isValid()){
            // $todo->setParent($user);
            $slug = $slugger->slug($todo->getTache());
            $todo->setTache($slug);

            //On stocke
            $em->persist($todo);
            $em->flush();

            $this->addFlash('success', 'Tache ajoutée avec succès');

            // On redirige
            return $this->redirectToRoute('todo_index');

        }

        return $this->render('todo/add.html.twig', [
            'todoForm' => $todoForm->createView()
        ]);
    
    }
        

    #[Route('/edition/{id}', name: 'edit')]
    public function edit(Todo $todo, Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        

        // On crée le formulaire
        $todoForm = $this->createForm(TodoFormType::class, $todo);

        // On traite la requête du formulaire
        $todoForm->handleRequest($request);

            // dd($todo);
        
        // On vérifie si le formulaire est soumis et valide
        if($todoForm->isSubmitted() && $todoForm->isValid()){
            // dd($todo);
            $slug = $slugger->slug($todo->getTache());
            $todo->setTache($slug);

            //On stocke
            $em->persist($todo);
            $em->flush();


            // On redirige
            return $this->redirectToRoute('todo_index');
        }

        return $this->render('todo/edit.html.twig', [
            'todoForm' => $todoForm->createView()
        ]);
        
    }

    #[Route('/suppression/{id}', name: 'delete')]
    public function delete(Todo $todo, Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $todo->getTache();

        //On stocke
        $em->remove($todo);
        $em->flush();
        
        // On redirige
        return $this->redirectToRoute('todo_index');
    }


}
