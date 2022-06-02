<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
