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
}
