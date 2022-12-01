<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Consultation;
use App\Form\ConsultationType;

class ConsultationController extends AbstractController
{
    //AFFICHAGE DES CONSULTATIONS
    #[Route('/consultations', name: 'consultations')]
    public function getConsultations(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Consultation::class);
        $lesConsultations = $repository->findAll();
        return $this->render('consultation/index.html.twig', [
            'consultations' => $lesConsultations,
            'title' => 'Liste des consultations',
        ]);
    }

    //AFFICHAGE D'UNE CONSULTATION
    #[Route('/consultation/{id}', name: 'consultation')]
    public function getUneConsultation(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        $repository = $doctrine->getRepository(Consultation::class);
        $lesConsultations = $repository->find($id);
        return $this->render('consultation/index.html.twig', [
            'consultations' => $lesConsultations,
            'title' => 'Liste des consultations',
        ]);
    }

    //AJOUTER UNE CONSULTATION
    #[Route('/ajout_consultation', name: 'ajout_consultation')]
    public function ajoutConsultation(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $consultation = new Consultation();
        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $consultation = $form->getData();
            $em->persist($consultation);
            $em->flush();
            return $this->redirectToRoute('consultations');
        }
        return $this->render('consultation/formulaire.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Ajouter une consultation'
        ));
    }

    //MODIFIER UNE CONSULTATION
    #[Route('/modifier_consultation/{id}', name: 'modifier_consultation')]
    public function modifierConsultation(ManagerRegistry $doctrine, Request $request, $id): Response
    {
        $repository=$doctrine->getRepository(Consultation::class);
        $em = $doctrine->getManager();
        $consultation = $repository->find($id);
        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $consultation = $form->getData();
            $em->persist($consultation);
            $em->flush();
            return $this->redirectToRoute('consultations');
        }
        return $this->render('consultation/formulaire.html.twig', array(
            'form' => $form->createView(),
            'title' => 'Modifier une consultation'
        ));
    }

    //SUPPRIMER UNE CONSULTATION
    #[Route('/supprimer_consultation/{id}', name: 'supprimer_consultation')]
    public function supprimerConsultation(ManagerRegistry $doctrine, $id): Response
    {
        $repository=$doctrine->getRepository(Consultation::class);
        $consultation=$repository->find($id);
        $em=$doctrine->getManager();
        $em->remove($consultation);
        $em->flush();
        return $this->redirectToRoute('consultations');
    }
}
