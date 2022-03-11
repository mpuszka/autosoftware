<?php

namespace App\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
  /**
  * @Route("/article", name="app_article")
  */
  public function index(): Response
  {
    return $this->render('article/index.html.twig');
  }

  /**
  * @Route("/article/{id}", name="app_single_article")
  */
  public function article(int $id): Response
  {
    return $this->render('article/article.html.twig', ['id' => $id]);
  }
}
