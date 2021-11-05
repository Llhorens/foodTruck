<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;


class CartController extends AbstractController
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    /**
     * @Route("/cart", name="cart")
     * @param Session $session
     */
    public function cart(Session $session, ProductRepository $productRepository)
    {
        $paniers = $session->get('panier');

        $commandes = array();
        if (!empty($paniers)) {
            foreach ($paniers as $panier) {

                $quantity = $panier[1];
                $product = $productRepository->findOneBy(['id' => $panier[0]]);
                $commandes[] = [0 => $product, 1 => $quantity];
            }
        }

        return $this->render('pages/cart.html.twig', [
            'commandes' => $commandes
        ]);
    }

    /**
     * @Route("/cart/{id}/{quantity}", name="addToCart")
     * @param Session $session
     */
    public function addToCart($id,  $quantity, Session $session)
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier');

        $i = 0;
        $index = 0;
        if ($panier != NULL) {
            $toggle = FALSE;
            foreach ($panier as $product) {
                if ($product[0] == $id) {
                    $toggle = TRUE;
                    $index = $i;
                }
                $i++;
            }

            if ($toggle == FALSE) {
                $panier[] = [$id, $quantity];
                $session->set('panier', $panier);
            } else {
                $panier[$index] = [$id, $quantity];
                $session->set('panier', $panier);
            }
        } else {
            //si aucune session n'existe.
            $panier[] = [$id, $quantity];
            $session->set('panier', $panier);
        }
        return $response = new JsonResponse(["nombre" => count($panier)]);
        return $this->render('pages/addToCart.html.twig');
    }

    /**
     * @Route("/cart/add", name="add_cart")
     * @param Session $session
     */
    public function add(Session $session, ProductRepository $productRepository)
    {
        $paniers = $session->get("panier");
        $commandes = array();
        $product = array();
        $quantity = array();
        if (!empty($paniers)) {
            foreach ($paniers as $panier) {

                $quantity = $panier[1]++;
                $product = $productRepository->findOneBy(['id' => $panier[0]]);

                $commandes[] = [0 => $product, 1 => $quantity];
            }

            $session->set("panier", $commandes);

            return $this->redirectToRoute('cart');
        }



        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart", name="remove_cart")
     * @param Session $session
     */
    public function remove(Session $session, Product $product)
    {
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if (!empty($panier[$id])) {

            if ($panier[$id] > 1) {

                $panier[$id]--;
            } else {

                unset($panier[$id]);
            }
        }

        $session->set("panier", $panier);

        return $this->redirectToRoute("pages/cart.html.twig");
    }

    /**
     * @Route("/cart", name="del_cart")
     * @param Session $session
     */
    public function delete(Session $session, Product $product)
    {
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if (!empty($panier[$id])) {

            unset($panier[$id]);
        }
        $session->set("panier", $panier);

        return $this->redirectToRoute("pages/cart.html.twig");
    }


    /**
     * @Route("/cart/deleteall", name="del__all_cart")
     * @param Session $session
     */
    public function deleteAll(Session $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("pages/cart.html.twig");
    }
}
