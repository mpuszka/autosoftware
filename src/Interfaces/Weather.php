<?php

namespace App\Interfaces;

interface Weather
{
  public function prepareQuery(string $city, string $country);

  public function getLocationName();

  public function getTemp();
}
