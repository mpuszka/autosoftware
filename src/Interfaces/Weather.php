<?php

namespace App\Interfaces;

interface Weather
{
  public function makeRequest(object $requestService, string $city, string $country): object;

  public function prepareQuery(string $city, string $country);

  public function getLocationName();

  public function getTemp();
}
