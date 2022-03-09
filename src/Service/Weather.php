<?php

namespace App\Service;

use ReflectionClass;

class Weather
{
  private $provider;

  public function __construct(?string $provider)
  {
    $this->provider = new ReflectionClass((class_exists('App\Service\Weather\\' . $provider)) ? 'App\Service\Weather\\' . $provider : 'App\Service\Weather\OpenWeather');
  }

  public function getProvider(): object
  {
    return $this->provider;
  }
}
