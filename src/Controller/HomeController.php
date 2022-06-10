<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Functions;

class HomeController extends AbstractController {

    // En injectant directement la classe au niveau du constructeur, on 
    // évitera d'avoir besoin de l'injecter dans chaque class.
private $functions;

public function __construct(Functions $functions)
{
    $this->functions = $functions;
}

    /**
     * @Route("/",name="app_home")
     */
    public function index():Response{
        $a = "Accueil";
        $result = $this->functions->mult(3,5);
        return $this->render("pages/home.html.twig", ["titre"=>$a, "result"=>$result]);
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