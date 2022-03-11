<?php

namespace App\Entity;

use App\Repository\WeatherRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeatherRepository::class)
 */
class Weather
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="float")
   */
  private $lat;

  /**
   * @ORM\Column(type="float")
   */
  private $lon;

  /**
   * @ORM\Column(type="float")
   */
  private $temp;

  /**
   * @ORM\Column(type="integer")
   */
  private $pressure;

  /**
   * @ORM\Column(type="float")
   */
  private $wind;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $country;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $city;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getLat(): ?float
  {
    return $this->lat;
  }

  public function setLat(float $lat): self
  {
    $this->lat = $lat;

    return $this;
  }

  public function getLon(): ?float
  {
    return $this->lon;
  }

  public function setLon(float $lon): self
  {
    $this->lon = $lon;

    return $this;
  }

  public function getTemp(): ?float
  {
    return $this->temp;
  }

  public function setTemp(float $temp): self
  {
    $this->temp = $temp;

    return $this;
  }

  public function getPressure(): ?int
  {
    return $this->pressure;
  }

  public function setPressure(int $pressure): self
  {
    $this->pressure = $pressure;

    return $this;
  }

  public function getWind(): ?float
  {
    return $this->wind;
  }

  public function setWind(float $wind): self
  {
    $this->wind = $wind;

    return $this;
  }

  public function getCountry(): ?string
  {
    return $this->country;
  }

  public function setCountry(string $country): self
  {
    $this->country = $country;

    return $this;
  }

  public function getCity(): ?string
  {
    return $this->city;
  }

  public function setCity(string $city): self
  {
    $this->city = $city;

    return $this;
  }
}
