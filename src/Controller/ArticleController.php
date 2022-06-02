<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id}", name="app_article")
     */
    public function index(ArticleRepository $ArticleRepo, $id): Response
    {
        return $this->render('article/index.html.twig', [
            "article" => $ArticleRepo->find($id)
        ]);
    }

    /**
     * @Route("/article/recherche/{name}", requirements={"name"="[a-zA-Z]+"}, name="app_article_search_name")
     */
    public function searchName(ArticleRepository $ArticleRepo, $name): Response
    {

        dd($ArticleRepo->findByName($name));
        return $this->render('article/index.html.twig');
    }

    /**
     * @Route("/article/recherche/{op}/{price}", requirements={"op"="[a-zA-Z]{2}", "price"="[0-9]+\.{0,1}[0-9]+"}, name="app_article_search_price")
     */
    public function searchPrice(ArticleRepository $ArticleRepo, $price, $op): Response
    {

        dd($ArticleRepo->findByPrice($price, $op));
        return $this->render('article/index.html.twig');
    }
}
