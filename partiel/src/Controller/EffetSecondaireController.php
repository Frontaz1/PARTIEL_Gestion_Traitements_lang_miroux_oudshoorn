<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\EffetSnd;
use App\Form\EffetSndType;

class EffetSecondaireController extends AbstractController
{
    #[Route('/effets/secondaires', name: 'effets/secondaires')]
    public function getEffetsSecondaires(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(EffetSnd::class);
        $effetsSec = $repository->findAll();
        return $this->render('effet_secondaire/index.html.twig', [
            'effetssnd' => $effetsSec,
            'title' => 'Liste des effets secondaires',
        ]);
    }

    #[Route('/effet/secondaire/{id}', name: 'effet/secondaire')]
    public function getEffetSecondaire(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        $repository = $doctrine->getRepository(EffetSnd::class);
        $effetsSec = $repository->find($id);
        return $this->render('effet_secondaire/index.html.twig', [
            'effetssnd' => $effetsSec,
            'title' => 'Liste des effets secondaires',
        ]);
    }

    #[Route('/ajout_effet', name:'ajout_effet')]
    public function ajouEffet(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $effet = new EffetSnd();
        $form = $this->createForm(EffetSndType::class, $effet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $effet = $form->getData();
            $em->persist($effet);
            $em->flush();
            return $this->redirectToRoute('effets/secondaires');
        }
        return $this->render('base/formulaire.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Ajouter un effet secondaire'
        ));
    }

    #[Route('/modifier_effet/{id}', name:'modifier_effet')]
    public function modifEffet(ManagerRegistry $doctrine, Request $request, $id): Response
    {
        $repository=$doctrine->getRepository(EffetSnd::class);
        $em = $doctrine->getManager();
        $effet = $repository->find($id);
        $form = $this->createForm(EffetSndType::class, $effet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $effet = $form->getData();
            $em->persist($effet);
            $em->flush();
            return $this->redirectToRoute('effets/secondaires');
        }
        return $this->render('base/formulaire.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Modifier l\'effet secondaire'
        ));
    }

    #[Route('/supprimer/effet/{id}', name: 'supprimer/effet')]
    public function supprimerEffet(ManagerRegistry $doctrine, $id): Response
    {
        $repository=$doctrine->getRepository(EffetSnd::class);
        $effet=$repository->find($id);
        $em=$doctrine->getManager();
        $em->remove($effet);
        $em->flush();
        return $this->redirectToRoute('effets/secondaires');
    }
}
