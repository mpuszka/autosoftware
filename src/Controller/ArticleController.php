<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Article;

class ArticleController extends AbstractController
{
  /**
  * @Route("/article", name="app_article")
  */
  public function index(ManagerRegistry $doctrine): Response
  {
    return $this->render('article/index.html.twig', [
      'articles' => $doctrine->getManager()->getRepository(Article::class)->findAll(),
      'controller_name' => 'ArticleController',
    ]);
  }

  /**
  * @Route("/article/{id}", name="app_single_article")
  */
  public function article(int $id): Response
  {
    return $this->render('article/article.html.twig');
  }
}
