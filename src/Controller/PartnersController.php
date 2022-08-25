<?php

namespace App\Controller;

use App\Entity\Partners;
use App\Entity\Users;
use App\Form\PartnersType;
use App\Repository\PartnersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/partners')]
class PartnersController extends AbstractController
{
    #[Route('/', name: 'app_partners_index', methods: ['GET'])]
    public function index(PartnersRepository $partnersRepository): Response
    {
        return $this->render('partners/index.html.twig', [
            'partners' => $partnersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_partners_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PartnersRepository $partnersRepository, EntityManagerInterface $entityManager): Response
    {
        $partner = new Partners();
        $form = $this->createForm(PartnersType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on prend toute la partie qui est dans user
            $user = $form->get('users') -> getData();
            // dd($user -> getRolesUsers() -> getName());
            $r[]=$user -> getRolesUsers() -> getName();
            $user->setRoles($r);
            $entityManager->persist($form->get('users') -> getData());
            $partnersRepository->add($partner, true);
            //persiste
            
            $user= new Users();
           
            return $this->redirectToRoute('app_partners_index', [], Response::HTTP_SEE_OTHER);


        }

    

        return $this->renderForm('partners/new.html.twig', [
            'partner' => $partner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partners_show', methods: ['GET'])]
    public function show(Partners $partner): Response
    {
        return $this->render('partners/show.html.twig', [
            'partner' => $partner,
        ]);
    }

    #[Route('/structures/{id}', name: 'app_partners_structures', methods: ['GET'])]
    public function showPartners(Partners $partner): Response
    {
        return $this->render('partners/show_structures.html.twig', [
            'partner' => $partner,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_partners_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Partners $partner, PartnersRepository $partnersRepository): Response
    {
        $form = $this->createForm(PartnersType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $partnersRepository->add($partner, true);

            return $this->redirectToRoute('app_partners_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('partners/edit.html.twig', [
            'partner' => $partner,
            'user' => $partner->getUsers(),
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partners_delete', methods: ['POST'])]
    public function delete(Request $request, Partners $partner, PartnersRepository $partnersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partner->getId(), $request->request->get('_token'))) {
            $partnersRepository->remove($partner, true);
        }

        return $this->redirectToRoute('app_partners_index', [], Response::HTTP_SEE_OTHER);
    }
}
