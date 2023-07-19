<?php

namespace App\Controller;

use App\Entity\ProductAvailability;
use App\Form\ProductAvailabilityType;
use App\Repository\ProductAvailabilityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product/availability')]
class ProductAvailabilityController extends AbstractController
{
    #[Route('/', name: 'app_product_availability_index', methods: ['GET'])]
    public function index(ProductAvailabilityRepository $productAvailabilityRepository): Response
    {
        return $this->render('product_availability/index.html.twig', [
            'product_availabilities' => $productAvailabilityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_product_availability_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productAvailability = new ProductAvailability();
        $form = $this->createForm(ProductAvailabilityType::class, $productAvailability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productAvailability);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_availability_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_availability/new.html.twig', [
            'product_availability' => $productAvailability,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_availability_show', methods: ['GET'])]
    public function show(ProductAvailability $productAvailability): Response
    {
        return $this->render('product_availability/show.html.twig', [
            'product_availability' => $productAvailability,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_availability_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductAvailability $productAvailability, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductAvailabilityType::class, $productAvailability);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product_availability_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_availability/edit.html.twig', [
            'product_availability' => $productAvailability,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_availability_delete', methods: ['POST'])]
    public function delete(Request $request, ProductAvailability $productAvailability, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productAvailability->getId(), $request->request->get('_token'))) {
            $entityManager->remove($productAvailability);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_availability_index', [], Response::HTTP_SEE_OTHER);
    }
}
