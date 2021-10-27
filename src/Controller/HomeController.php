<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{

    /**
     * @var ProductRepository
     */
    private $repository;

    /**
     * @Route("/", name="home")
     * @return \Symfony\Component_HttpFoundation\Response
     */
    public function index(ProductRepository $repository)
    {

        $products = $repository->findAll();
        return $this->render('pages/home.html.twig', compact('products'));
    }
    
}
