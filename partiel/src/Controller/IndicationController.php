<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndicationController extends AbstractController
{
    #[Route('/indication', name: 'app_indication')]
    public function index(): Response
    {
        return $this->render('indication/index.html.twig', [
            'controller_name' => 'IndicationController',
        ]);
    }
}
