<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Indication;
use App\Entity\Patient;
use Symfony\Component\HttpFoundation\Request;
use App\Form\IndicationType;

class IndicationController extends AbstractController
{
    #[Route('/indications', name: 'indications')]
    public function getIndications(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Indication::class);
        $lesIndications=$repository->findAll();
        return $this->render('indication/index.html.twig', [
            'title' => 'Liste des indications',
            'indications'     => $lesIndications,
        ]);
    }

    #[Route('/indication/{id}', name: 'indication')]
    public function getUneIndication(ManagerRegistry $doctrine, $id): Response
    {
        $repository=$doctrine->getRepository(Indication::class);
        $lesIndications=$repository->find($id);
        return $this->render('indication/index.html.twig', [
            'title' => 'L\'indication',
            'indications'     => $lesIndications,
        ]);
    }

    #[Route('/formulaireIndication', name: 'formulaireIndication')]
    public function formulaire(ManagerRegistry $doctrine, Request $request): Response
    {
        $em=$doctrine->getManager();
        $indication=new Indication();

        $form = $this->createForm(IndicationType::class, $indication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $indication = $form->getData();
            $em->persist($indication);
            $em->flush();
            // redirection vers la liste des indications
            return $this->redirectToRoute('indications');
        }
        return $this->render('base/formulaire.html.twig', [
            'controller_name' => 'Création d\'une indication',
            'form'            => $form->createView(),
        ]);
    }

    #[Route('/modifIndication/{id}',name: 'modifIndication')]
    public function modifIndication(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        $repository=$doctrine->getRepository(Indication::class);
        $indication=$repository->find($id);
        $em=$doctrine->getManager();

        $form = $this->createForm(IndicationType::class, $indication);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $indication = $form->getData();
            $em->persist($indication);
            $em->flush();
            // redirection vers la liste des adhérents
            return $this->redirectToRoute('indications');
        }
        return $this->render('base/formulaire.html.twig', [
            'controller_name' => 'Modification d\'une indication',
            'form'            => $form->createView(),
        ]);
    }

    #[Route('/supprIndication/{id}',name: 'supprIndication')]
    public function supprIndication(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        $repository=$doctrine->getRepository(Indication::class);
        $uneIndication=$repository->find($id);
        $em=$doctrine->getManager();
        if($uneIndication != null){
            $em->remove($uneIndication);
        }
        $em->flush();
        return $this->redirectToRoute('indications');;
    }

    #[Route('/lesPatients', name: 'lesPatients')]
    public function lesPatients(ManagerRegistry $doctrine): Response
    {
        $repository=$doctrine->getRepository(Patient::class);
        $lesPatients=$repository->findAll();
        return $this->render('indication/patients.html.twig', [
            'controller_name' => 'Les patients',
            'patients'     => $lesPatients,
        ]);
    }
}
