<?php

namespace App\Service;

use App\Integrations\OpenWeather\OpenWeather;
use App\Interfaces\Weather as WeatherInterface;

class Weather
{
  public static function getProvider(string $provider): WeatherInterface
  {
    switch ($provider) {
      case 'openweather':
      default:
        $provider = new OpenWeather();
          break;
    }

    return $provider;
  }
}
