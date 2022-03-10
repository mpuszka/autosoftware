<?php

namespace App\Interfaces;

interface Weather
{
  public function makeRequest(object $requestService, string $city, string $country): object;

  public function prepareQuery(string $city, string $country);

  public function getLat();

  public function getLon();

  public function getTemp();

  public function getPressure();

  public function getWindSpeed();

  public function getCountry();

  public function getCity();
}
