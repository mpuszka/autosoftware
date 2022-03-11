<?php

namespace App\Command;

use App\API\Request;
use App\Service\Weather;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Weather as WeatherEntity;

class ApiGetWeatherCommand extends Command
{
  private $request;

  private $doctrine;

  protected static $defaultName = 'api:get-weather';

  protected static $defaultDescription = 'Get weather data from the provided service provider.';

  public function __construct(Request $request, ManagerRegistry $doctrine)
  {
    $this->request = $request;
    $this->doctrine = $doctrine;
    parent::__construct();
  }

  protected function configure(): void
  {
    $this->addArgument('city', InputArgument::REQUIRED, 'Argument description');
    $this->addArgument('country', InputArgument::REQUIRED, 'Argument description');
    $this->addArgument('provider', InputArgument::OPTIONAL, 'Argument description');
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $io = new SymfonyStyle($input, $output);

    $city = $input->getArgument('city');
    $country = $input->getArgument('country');

    $io->note(sprintf('You passed a city: %s', $city));
    $io->note(sprintf('You passed a country: %s', $country));

    $weatherProvider = Weather::getProvider($input->getArgument('provider') ?: 'openweather');

    $io->success(sprintf('We are getting the weather from: %s', $input->getArgument('provider') ?: 'openweather'));

    $weatherProvider->makeRequest($this->request, $city, $country);

    if (200 !== $this->request->getResponseStatusCode()) {
      $io->error(sprintf('Oops - something goes wrong: %s', $this->request->getRequestMessage()));
      return Command::FAILURE;
    }

    $entityManager = $this->doctrine->getManager();

    $weatherEntity = new WeatherEntity();
    $weatherEntity->setLat($weatherProvider->getLat());
    $weatherEntity->setLon($weatherProvider->getLon());
    $weatherEntity->setTemp($weatherProvider->getTemp());
    $weatherEntity->setPressure($weatherProvider->getPressure());
    $weatherEntity->setWind($weatherProvider->getWindSpeed());
    $weatherEntity->setCountry($weatherProvider->getCountry());
    $weatherEntity->setCity($weatherProvider->getCity());

    $entityManager->persist($weatherEntity);
    $entityManager->flush();

    $io->success(sprintf('We save the data form city %s and country %s', $city, $country));

    return Command::SUCCESS;
  }
}
