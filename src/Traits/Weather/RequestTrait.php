<?php

namespace App\Traits\Weather;

trait RequestTrait
{
  public function makeRequest(object $requestService, string $city, string $country): object
  {
    $requestService->makeRequest($this->prepareQuery($city, $country));
    $content = json_decode($requestService->getResponseContent());
    $this->setResponse($content);

    return $this->response;
  }

  public function getResponse(): object
  {
    return $this->response;
  }

  public function setResponse(object $response): void
  {
    $this->response = $response;
  }
}
