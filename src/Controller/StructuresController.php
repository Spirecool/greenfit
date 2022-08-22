<?php

namespace App\Controller;

use App\Entity\Structures;
use App\Form\StructuresType;
use App\Repository\StructuresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/structures')]
class StructuresController extends AbstractController
{
    #[Route('/', name: 'app_structures_index', methods: ['GET'])]
    public function index(StructuresRepository $structuresRepository): Response
    {
        return $this->render('structures/index.html.twig', [
            'structures' => $structuresRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_structures_new', methods: ['GET', 'POST'])]

    public function new(Request $request, StructuresRepository $structuresRepository, EntityManagerInterface $entityManager): Response
    {
        // créer une structure et son user associé 
        $structure = new Structures();
        $form = $this->createForm(StructuresType::class, $structure);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            
            //on prend toute la partie qui est dans user
            $user = $form->get('users') -> getData();
            // dd($user -> getRolesUsers() -> getName());
            $r[]=$user -> getRolesUsers() -> getName();
            $user->setRoles($r);
            $entityManager->persist($form->get('users') -> getData());

            $structuresRepository->add($structure, true);

            return $this->redirectToRoute('app_structures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structures/new.html.twig', [
            'structure' => $structure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_structures_show', methods: ['GET'])]
    public function show(Structures $structure): Response
    {
        return $this->render('structures/show.html.twig', [
            'structure' => $structure,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_structures_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Structures $structure, StructuresRepository $structuresRepository): Response
    {
        $form = $this->createForm(StructuresType::class, $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $structuresRepository->add($structure, true);

            return $this->redirectToRoute('app_structures_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structures/edit.html.twig', [
            'structure' => $structure,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_structures_delete', methods: ['POST'])]
    public function delete(Request $request, Structures $structure, StructuresRepository $structuresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$structure->getId(), $request->request->get('_token'))) {
            $structuresRepository->remove($structure, true);
        }

        return $this->redirectToRoute('app_structures_index', [], Response::HTTP_SEE_OTHER);
    }
}
