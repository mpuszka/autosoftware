<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Blog;

class BlogController extends AbstractController
{
  /**
  * @Route("/blog", name="app_blog")
  */
  public function index(ManagerRegistry $doctrine): Response
  {
    return $this->render('blog/index.html.twig', [
      'articles' => $doctrine->getManager()->getRepository(Blog::class)->findAll(),
      'controller_name' => 'BlogController',
    ]);
  }

  /**
  * @Route("/blog/{id}", name="app_single_blog")
  */
  public function blog(int $id): Response
  {
    return $this->render('blog/article.html.twig');
  }
}
