<?php

namespace App\Service;

use ReflectionClass;
use App\Interfaces\Weather as WeatherInterface;

class Weather
{
  private $provider;

  public function __construct(?string $provider)
  {
    $this->provider = new ReflectionClass((class_exists('App\Service\Weather\\' . $provider)) ? 'App\Service\Weather\\' . $provider : 'App\Service\Weather\OpenWeather');
  }

  public function getProvider(): WeatherInterface
  {
    return $this->provider->newInstance();
  }
}
