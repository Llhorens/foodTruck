<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AdminProfileController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_profile")
     */
    public function profile()
    {
        return $this->render('admin/profile.html.twig');
    }
}
