<?php

namespace App\Integrations\OpenWeather;

use App\Interfaces\Weather as WeatherInterface;
use App\Traits\Weather\RequestTrait;

/**
 * Open weather service
 */
class OpenWeather implements WeatherInterface
{
  use RequestTrait;

  private $response;

  private const API_KEY = '3d187365a47abb8c797eb64fb29f2beb';

  private const API_URL = 'http://api.openweathermap.org/data/2.5/weather';

  public function getLocationName(): string
  {
    return $this->response->name;
  }

  public function getTemp(): float
  {
    $temp = $this->getMain()->temp - 272.15;

    return (float) number_format($temp, 1);
  }

  public function prepareQuery(string $city, string $country): string
  {
    $query = self::API_URL;
    $query .= '?q=' . $city . ',' . $country;
    $query .= '&appid=' . self::API_KEY;

    return $query;
  }

  private function getMain(): object
  {
    return $this->response->main;
  }
}
