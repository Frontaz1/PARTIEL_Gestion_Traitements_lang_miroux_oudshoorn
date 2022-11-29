<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Consultation;

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
}
