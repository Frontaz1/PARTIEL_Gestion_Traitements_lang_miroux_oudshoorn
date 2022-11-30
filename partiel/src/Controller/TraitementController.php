<?php

namespace App\Controller;

use App\Entity\Traitement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class TraitementController extends AbstractController
{
    #[Route('/traitement', name: 'app_traitement')]
    public function index(): Response
    {
        return $this->render('traitement/index.html.twig', [
            'controller_name' => 'TraitementController',
        ]);
    }

    
    #[Route('/traitements', name: 'traitements')]
    public function getTraitements(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Traitement::class);
        $lesTraitements=$repository->findAll();
        return $this->render('traitement/index.html.twig', [
            'title' => 'LES TRAITEMENTS',
            'traitements' => $lesTraitements,
            

        ]);
    }

    #[Route('/traitement/{id}', name: 'traitement')]
    public function getUnTraitement(ManagerRegistry $doctrine, $id): Response
    {
        //accès au répository de la classe adherent
        $repository=$doctrine->getRepository(Traitement::class);
        //recup de tous les adherents
        $unTraitement=$repository->find($id);

        return $this->render('traitement/index.html.twig', [
            'title'=>'Le traitement',
            'traitements'=>$unTraitement
        ]);
    }
}
