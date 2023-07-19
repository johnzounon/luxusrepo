<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/administration/categories')]
class CategoryController extends AbstractController
{
    #[Route('/liste', name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAllByRanking(),
        ]);
    }

    #[Route('/nouveau', name: 'app_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setTitleFrSlug($slugger->slug($category->getTitleFr()));
            $category->setTitleDeSlug($slugger->slug($category->getTitleDe()));
            $category->setTitleItSlug($slugger->slug($category->getTitleIt()));
            $category->setUser($this->getUser());
            $category->setEditUser($this->getUser());
            $category->setCreatedAt(new \DateTime());
            $category->setUpdatedAt(new \DateTime());
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'La catégorie <<'.$category->getTitleFr().'>> est disponible');
            return $this->redirectToRoute('app_category_new');
        }

        return $this->render('category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/details/{id}', name: 'app_category_show', methods: ['GET'])]
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/edition/{id}', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setTitleFrSlug($slugger->slug($category->getTitleFr()));
            $category->setTitleDeSlug($slugger->slug($category->getTitleDe()));
            $category->setTitleItSlug($slugger->slug($category->getTitleIt()));
            $category->setEditUser($this->getUser());
            $category->setUpdatedAt(new \DateTime());
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'La catégorie <<'.$category->getTitleFr().'>> est disponible');
            return $this->redirectToRoute('app_category_edit', ['id'=>$category->getId()]);
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/suppression/{id}', name: 'app_category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
            $this->addFlash('success', 'La catégorie <<'.$category->getTitleFr().'>> a été supprimée');
        }

        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
