<?php

namespace App\Controller;

use App\Entity\ProductCondition;
use App\Form\ProductConditionType;
use App\Repository\ProductConditionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product/condition')]
class ProductConditionController extends AbstractController
{
    #[Route('/', name: 'app_product_condition_index', methods: ['GET'])]
    public function index(ProductConditionRepository $productConditionRepository): Response
    {
        return $this->render('product_condition/index.html.twig', [
            'product_conditions' => $productConditionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_product_condition_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productCondition = new ProductCondition();
        $form = $this->createForm(ProductConditionType::class, $productCondition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productCondition);
            $entityManager->flush();

            return $this->redirectToRoute('app_product_condition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_condition/new.html.twig', [
            'product_condition' => $productCondition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_condition_show', methods: ['GET'])]
    public function show(ProductCondition $productCondition): Response
    {
        return $this->render('product_condition/show.html.twig', [
            'product_condition' => $productCondition,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_condition_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductCondition $productCondition, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductConditionType::class, $productCondition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_product_condition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_condition/edit.html.twig', [
            'product_condition' => $productCondition,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_condition_delete', methods: ['POST'])]
    public function delete(Request $request, ProductCondition $productCondition, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productCondition->getId(), $request->request->get('_token'))) {
            $entityManager->remove($productCondition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_product_condition_index', [], Response::HTTP_SEE_OTHER);
    }
}
