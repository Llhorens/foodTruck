<?php

namespace App\Controller\Admin;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ManageProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @Route("/manageProduct", name="admin_manage_product")
     */
    public function manageProduct()
    {
        return $this->render('admin/product.html.twig');
    }
}
