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

    $weatherProvider = Weather::getProvider($input->getArgument('provider') ?: 'openweather');
    $weatherProvider->makeRequest($this->request, $city, $country);
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

    if ($city) {
      $io->note(sprintf('You passed an argument: %s', $city));
    }

    $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

    return Command::SUCCESS;
  }
}
