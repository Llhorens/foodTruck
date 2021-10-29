<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ManageCategoryController extends AbstractController
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository,  EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/manageCategory", name="admin_manage_category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function manageCategory()
    {
        $categories = $this->repository->findAll();
        return $this->render('admin/category.html.twig', compact('categories'));
    }

    /**
     * @Route("/manageCategory/create", name="admin_new_category")
     */
    public function new(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($category);
            $this->em->flush();
            return $this->redirectToRoute('admin_manage_category');
        }

        return $this->render('admin/newCategory.html.twig', [
            'Category' => $category,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/manageCategory/{id}", name="admin_edit_category")
     * @param Category $category
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editCategory(Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($category);
            $this->em->flush();
            return $this->redirectToRoute('admin_manage_category');
        }
        return $this->render('admin/editCategory.html.twig', [
            'Category' => $category,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/manageCategory/{id}", name="admin_delete_category")
     * @param Category $Category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteCategory(Category $category, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $category->getId(), $request->get('_token'))) {
            $this->em->remove($category);
            $this->em->flush();
        }
        return $this->redirectToRoute('admin_manage_category');
    }
}
