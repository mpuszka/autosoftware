<?php

namespace App\Integrations\OpenWeather;

use App\Interfaces\Weather as WeatherInterface;
use App\Traits\Weather\RequestTrait;

class OpenWeather implements WeatherInterface
{
  use RequestTrait;

  private $response;

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

  public function getCoords(): object
  {
    return $this->response->coord;
  }

  public function getLat(): float
  {
    return $this->getCoords()->lat;
  }

  public function getLon(): float
  {
    return $this->getCoords()->lon;
  }

  public function getTemp(): float
  {
    return (float) number_format(($this->getMain()->temp - 272.15), 1);
  }

  public function getPressure(): float
  {
    return $this->getMain()->pressure;
  }

  public function getWind(): object
  {
    return $this->response->wind;
  }

  public function getWindSpeed(): float
  {
    return $this->getWind()->speed;
  }

  public function getSys(): object
  {
    return $this->response->sys;
  }

  public function getCountry(): string
  {
    return $this->getSys()->country;
  }

  public function getCity(): string
  {
    return $this->response->name;
  }
}
