<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mon-compte', name: 'app_custom_')]
class CustomController extends AbstractController
{
    #[Route('/tableau-de-bord', name: 'index')]
    public function index(): Response
    {
        return $this->render('custom/index.html.twig', [
            'controller_name' => 'CustomController',
        ]);
    }
}
