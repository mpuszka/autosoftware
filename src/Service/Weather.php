<?php

namespace App\Service;

use App\Integrations\OpenWeather\OpenWeather;

class Weather
{
  public static function getProvider(string $provider)
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
