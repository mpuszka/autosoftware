<?php

namespace App\Controller\API\User;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractFOSRestController
{
  /**
   * @Rest\Get("/api/user")
   */
  public function index(ManagerRegistry $doctrine): View
  {
    $users = $doctrine->getManager()->getRepository(User::class)->findAll();
    $apiUsers = [];

    foreach ($users as $user) {
      $apiUsers[] = [
        'id' => $user->getId(),
        'name' => $user->getName(),
        'email' => $user->getEmail(),
      ];
    }

    return View::create($apiUsers, Response::HTTP_OK);
  }
}
