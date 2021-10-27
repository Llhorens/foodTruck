<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ManageProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ProductRepository $repository,  EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/manageProduct", name="admin_manage_product")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function manageProduct()
    {
        $products = $this->repository->findAll();
        return $this->render('admin/product.html.twig', compact('products'));
    }
    /**
     * @Route("/manageProduct/create", name="admin_new_product")
     */
    public function new(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($product);
            $this->em->flush();
            return $this->redirectToRoute('admin_manage_product');
        }

        return $this->render('admin/newProduct.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/manageProduct/{id}", name="admin_edit_product")
     * @param Product $product
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editProduct(Product $product, Request $request)
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($product);
            $this->em->flush();
            return $this->redirectToRoute('admin_manage_product');
        }
        return $this->render('admin/editProduct.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/manageproduct/{id}", name="admin_delete_product")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteProduct(Product $product, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->get('_token'))) {
            $this->em->remove($product);
            $this->em->flush();
        }
        return $this->redirectToRoute('admin_manage_product');
    }
}
