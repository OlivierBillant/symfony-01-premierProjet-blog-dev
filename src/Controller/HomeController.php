<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/",name="app_home")
     */
    public function index():Response{
        $a = "Accueil";
        return $this->render("pages/home.html.twig", ["titre"=>$a]);
    }


     /**
     * @Route("/blog",name="app_blog")
     */
    public function blog():Response{
        return $this->render("pages/blog.html.twig");
    }

    /**
     * @Route("/a-propos",name="app_about")
     */
    public function about():Response{
        return $this->render("pages/a-propos.html.twig");
    }

    /**
     * @Route("/contact",name="app_contact")
     */
    public function contact():Response{
        return $this->render("pages/contact.html.twig");
    }
}