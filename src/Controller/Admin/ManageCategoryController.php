<?php

namespace App\Controller\AdminCategory;


use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ManageCategoryController extends AbstractController
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/manageCategory", name="admin_manage_category")
     */
    public function manageCategory()
    {
        return $this->render('admin/category.html.twig');
    }
}
