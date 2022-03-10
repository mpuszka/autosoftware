<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Article;

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
