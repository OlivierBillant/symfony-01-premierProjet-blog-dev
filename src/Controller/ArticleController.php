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
     * @Route("/article/recherche/{name}", name="app_article-search")
     */
    public function search(ArticleRepository $ArticleRepo, $name): Response
    {

        dd($ArticleRepo->findByName($name));
        return $this->render('article/index.html.twig');
    }
}
