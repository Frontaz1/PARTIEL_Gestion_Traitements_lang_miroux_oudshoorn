<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Indication;

class IndicationController extends AbstractController
{
    #[Route('/indication', name: 'indications')]
    public function getIndications(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Indication::class);
        $lesIndications=$repository->findAll();
        return $this->render('indication/index.html.twig', [
            'controller_name' => 'IndicationController',
            'indications'     => $lesIndications,
        ]);
    }

    #[Route('/indication/{id}', name: 'indication')]
    public function getUneIndication(ManagerRegistry $doctrine, $id): Response
    {
        $repository=$doctrine->getRepository(Indication::class);
        $lesIndications=$repository->find($id);
        return $this->render('indication/index.html.twig', [
            'controller_name' => 'IndicationController',
            'indications'     => $lesIndications,
        ]);
    }
}
