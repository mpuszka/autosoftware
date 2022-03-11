<?php

namespace App\Controller\API\Weather;

use App\Entity\Weather;
use Doctrine\Persistence\ManagerRegistry;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class WeatherController extends AbstractFOSRestController
{
  /**
   * @Rest\Get("/api/weather")
   */
  public function index(ManagerRegistry $doctrine, Request $request): View
  {
    $query = [];
    if ($city = $request->query->get('city')) {
      $query['city'] = $city;
    }

    if ($country = $request->query->get('country')) {
      $query['country'] = $country;
    }

    return View::create($doctrine->getManager()->getRepository(Weather::class)->findBy($query), Response::HTTP_OK);
  }
}
