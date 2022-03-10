<?php

namespace App\Controller\API\Article;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class APIController extends AbstractFOSRestController
{
  /**
   * @Rest\Get("/api/article")
   */
  public function index(ManagerRegistry $doctrine): View
  {
    return View::create($doctrine->getManager()->getRepository(Article::class)->findAll(), Response::HTTP_OK);
  }

  /**
   * @Rest\Get("/api/article/{id}")
   */
  public function article(ManagerRegistry $doctrine, int $id): View
  {
    if (! empty($data = $doctrine->getManager()->getRepository(Article::class)->find($id))) {
      return View::create($data, Response::HTTP_OK);
    }

    return View::create([], Response::HTTP_FOUND);
  }
}
