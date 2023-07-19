<?php

namespace App\Controller;

use App\Entity\SubCategory;
use App\Form\SubCategoryType;
use App\Repository\SubCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/administration/sous-categories')]
class SubCategoryController extends AbstractController
{
    #[Route('/liste', name: 'app_sub_category_index', methods: ['GET'])]
    public function index(SubCategoryRepository $subCategoryRepository): Response
    {
        return $this->render('sub_category/index.html.twig', [
            'sub_categories' => $subCategoryRepository->findAllByRanking(),
        ]);
    }

    #[Route('/nouveau', name: 'app_sub_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $sub_category = new SubCategory();
        $form = $this->createForm(SubCategoryType::class, $sub_category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sub_category->setTitleFrSlug($slugger->slug($sub_category->getTitleFr()));
            $sub_category->setTitleDeSlug($slugger->slug($sub_category->getTitleDe()));
            $sub_category->setTitleItSlug($slugger->slug($sub_category->getTitleIt()));
            $sub_category->setUser($this->getUser());
            $sub_category->setEditUser($this->getUser());
            $sub_category->setCreatedAt(new \DateTime());
            $sub_category->setUpdatedAt(new \DateTime());
            $entityManager->persist($sub_category);
            $entityManager->flush();
            $this->addFlash('success', 'La sous-catégorie <<'.$sub_category->getTitleFr().'>> est disponible');

            return $this->redirectToRoute('app_sub_category_new');
        }

        return $this->render('sub_category/new.html.twig', [
            'sub_category' => $sub_category,
            'form' => $form,
        ]);
    }

    #[Route('/details/{id}', name: 'app_sub_category_show', methods: ['GET'])]
    public function show(SubCategory $sub_category): Response
    {
        return $this->render('sub_category/show.html.twig', [
            'sub_category' => $sub_category,
        ]);
    }

    #[Route('/edition/{id}', name: 'app_sub_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SubCategory $sub_category, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(SubCategoryType::class, $sub_category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sub_category->setTitleFrSlug($slugger->slug($sub_category->getTitleFr()));
            $sub_category->setTitleDeSlug($slugger->slug($sub_category->getTitleDe()));
            $sub_category->setTitleItSlug($slugger->slug($sub_category->getTitleIt()));
            $sub_category->setEditUser($this->getUser());
            $sub_category->setUpdatedAt(new \DateTime());
            $entityManager->persist($sub_category);
            $entityManager->flush();
            $this->addFlash('success', 'La sous-catégorie <<'.$sub_category->getTitleFr().'>> est disponible');

            return $this->redirectToRoute('app_sub_category_edit', ['id'=>$sub_category->getId()]);
        }

        return $this->render('sub_category/edit.html.twig', [
            'sub_category' => $sub_category,
            'form' => $form,
        ]);
    }

    #[Route('/suppression/{id}', name: 'app_sub_category_delete', methods: ['POST'])]
    public function delete(Request $request, SubCategory $sub_category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sub_category->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sub_category);
            $entityManager->flush();
            $this->addFlash('success', 'La sous-catégorie <<'.$sub_category->getTitleFr().'>> a été supprimée');
        }

        return $this->redirectToRoute('app_sub_category_index');
    }
}
