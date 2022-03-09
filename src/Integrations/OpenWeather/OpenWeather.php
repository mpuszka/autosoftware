<?php

namespace App\Integrations\OpenWeather;

use App\Interfaces\Weather as WeatherInterface;
use App\Traits\Weather\RequestTrait;

class OpenWeather implements WeatherInterface
{
  use RequestTrait;

  private $response;

  public function getLocationName(): string
  {
    return $this->response->name;
  }

  public function getTemp(): float
  {
    return (float) number_format(($this->getMain()->temp - 272.15), 1);
  }

  public function prepareQuery(string $city, string $country): string
  {
    $query = $_ENV['OPENWEATHER_API_URL'];
    $query .= '?q=' . $city . ',' . $country;
    $query .= '&appid=' . $_ENV['OPENWEATHER_API_KEY'];

    return $query;
  }

  private function getMain(): object
  {
    return $this->response->main;
  }
}
