<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Medicament;

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
        'title' => 'Le médicament',
    ));
    }
}
