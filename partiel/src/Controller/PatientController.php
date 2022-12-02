<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Patient;

class PatientController extends AbstractController
{
    #[Route('/patients', name: 'patients')]
    public function getPatients(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Patient::class);
        $lesPatients = $repository->findAll();
        return $this->render('patient/index.html.twig', [
            'patients' => $lesPatients,
            'title' => 'Les patients',
        ]);
    }

    #[Route('/patient/{id}', name: 'patient')]
    public function getUnPatient(ManagerRegistry $doctrine, $id, Request $request): Response
    {
        $repository = $doctrine->getRepository(Patient::class);
        $patient = $repository->find($id);
        return $this->render('patient/index.html.twig', array(
            'patients' => $patient,
            'title' => 'Le patient'
    ));
    }
}
