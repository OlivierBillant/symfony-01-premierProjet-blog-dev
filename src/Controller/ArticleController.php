<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article1", name="app_article1")
     */
    public function index1(): Response
    {
        // Récupérer EM
        $em = $this->getDoctrine()->getManager();
        // Dépréciée

        // Instancier un article
        // L'ajouter a la db via l'EM
        $a = new Article();
        $a->setName("Iphone14");
        $a->setPrice(1000);
        $em->persist($a);
        //Ne suffit pas a créer l'article; Il sera seulement ajouté a une file;
        $em->flush();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }


    /**
     * @Route("/article2", name="app_article2")
     */
    public function index2(EntityManagerInterface $em): Response
    {
        // Ici on procède à une infection de dépendance directement dans les arguments de la fonction

        // Instancier un article
        // L'ajouter a la db via l'EM
        $a = new Article();
        $a->setName("Samsung GFold2");
        $a->setPrice(2000);
        $em->persist($a);
        //Ne suffit pas a créer l'article; Il sera seulement ajouté a une file;
        $em->flush();

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    // Les methodes de Read 

    // Lire un seul article

    /**
     * @Route("/lire-article1", name="app_lire_article1")
     */
    public function oneArticle1(ArticleRepository $ArticleRepo): Response
    {
        dd($ArticleRepo->find(2));
    }

    /**
     * @Route("/lire-article2", name="app_lire_article2")
     */
    public function oneArticle2(): Response
    {

        $ArticleRepo = $this->getDoctrine()->getRepository(Article::class);
        dd($ArticleRepo->find(1));
    }

    /**
     * @Route("/lire-article3/{id}", name="app_lire_article3")
     */
    public function oneArticle3(ArticleRepository $ArticleRepo, $id): Response
    {
        dd($ArticleRepo->find($id));
    }

    // ICI ON CREE UN FORMULAIRE
    /**
     * @Route("/article/ajouter", name="app_ajouterarticle")
     */
    public function addArticle(ArticleRepository $ArticleRepo, Request $request)
    {

        if ($this->getUser() == !null) {
            return $this->redirectToRoute('app_login');
        }

        $article = new Article();
        $articleForm = $this->createForm(ArticleType::class, $article);
        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $ArticleRepo->add($article, true);
            // Ajouter un message de confirmation
            $this->addFlash('success', 'Article ajouté');
            return $this->redirectToRoute("app_listearticle");
        }
        return $this->render("article/ajouter.html.twig", ["articleForm" => $articleForm->createView()]);
    }


    /**
     * @Route("/article/liste", name="app_listearticle")
     */
    public function listArticles(ArticleRepository $ArticleRepo)
    {
        $articleList = $ArticleRepo->findAll();
        return $this->render("article/list.html.twig", ["articleList" => $articleList]);
    }

    /**
     * @Route("/article/supprimer/{id}", name="app_article_remove", requirements={"id"="\d+"})
     */
    public function removeArticle(ArticleRepository $ArticleRepo, $id = null)
    {
        if ($id != null) {
            $article = $ArticleRepo->find($id);
            $ArticleRepo->remove($article, true);
        }
        return $this->redirectToRoute("app_listearticle");
    }

    /**
     * @Route("/article/modifier/{id}", name="app_article_update", requirements={"id"="\d+"})
     */
    public function updateArticle(Article $article, Request $request, EntityManagerInterface $em)
    {

        // $article = new Article();
        $articleForm = $this->createForm(ArticleType::class, $article);
        $articleForm->handleRequest($request);
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $em->flush();
            // Ajouter un message de confirmation
            $this->addFlash('success', 'Article modifié');
        }
        return $this->render("article/modifier.html.twig", ["articleForm" => $articleForm->createView()]);
    }

    /**
     * @Route("/apropos", name="app_apropos")
     */
    public function apropos()
    {
        return $this->render("pages/apropos.html.twig");
    }
}
