<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Medicament;
use App\Form\MedicamentType;

class MedicamentController extends AbstractController
{
    //AFFICHAGE DE TOUS LES MEDICAMENTS
    #[Route('/medicaments', name: 'medicaments')]
    public function getMedicaments(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Medicament::class);
        $lesMedicaments = $repository->findAll();
        return $this->render('medicament/index.html.twig', [
            'medicaments' => $lesMedicaments,
            'title' => 'Liste des médicaments',
        ]);
    }

    //AFFICHAGE D'UN MEDICAMENT
    #[Route('/medicament/{id}', name: 'medicament')]
    public function modifd(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        $repository = $doctrine->getRepository(Medicament::class);
        $lesMedicaments = $repository->find($id);
        return $this->render('medicament/index.html.twig', array(
            'medicaments' => $lesMedicaments,
            'title' => 'Le médicament'
    ));
    }

    //AJOUTER UN MEDICAMENT
    #[Route('/ajout_medicament', name: 'ajout_medicament')]
    public function ajoutMedicament(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $medicament = new Medicament();
        $form = $this->createForm(MedicamentType::class, $medicament);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $medicament = $form->getData();
            $em->persist($medicament);
            $em->flush();
            return $this->redirectToRoute('medicaments');
        }
        return $this->render('base/formulaire.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Ajouter un médicament'
        ));
    }

    //MODIFIER UNE CONSULTATION
    #[Route('/modifier_medicament/{id}', name: 'modifier_medicament')]
    public function modifierConsultation(ManagerRegistry $doctrine, Request $request, $id): Response
    {
        $repository=$doctrine->getRepository(Medicament::class);
        $em = $doctrine->getManager();
        $medicament = $repository->find($id);
        $form = $this->createForm(MedicamentType::class, $medicament);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $medicament = $form->getData();
            $em->persist($medicament);
            $em->flush();
            return $this->redirectToRoute('medicaments');
        }
        return $this->render('base/formulaire.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Modifier un médicament'
        ));
    }

    //SUPPRIMER UNE CONSULTATION
    #[Route('/supprimer_medicament/{id}', name: 'supprimer_medicament')]
    public function supprimerMedicament(ManagerRegistry $doctrine, $id): Response
    {
        $repository=$doctrine->getRepository(Medicament::class);
        $medicament=$repository->find($id);
        $em=$doctrine->getManager();
        $em->remove($medicament);
        $em->flush();
        return $this->redirectToRoute('medicaments');
    }
}
