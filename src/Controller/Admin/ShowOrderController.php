<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ShowOrderController extends AbstractController
{
    /**
     * @Route("/showOrder", name="admin_show_order")
     */
    public function manageProduct()
    {
        return $this->render('admin/order.html.twig');
    }
}




