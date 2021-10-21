<?php   

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $ProductRepository)
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $product = $repo->findAll();
        return $this->render('pages/home.html.twig');
    }
} 