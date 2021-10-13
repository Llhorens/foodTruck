<?php   

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class UserProfileController extends AbstractController
{
    /**
     * @Route("/user", name="user_profile")
     */
    public function profile()
    {
        return $this->render('profile/profile.html.twig');
    }
}