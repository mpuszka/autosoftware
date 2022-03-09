<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\Weather;
use App\API\Request;

class ApiGetWeatherCommand extends Command
{
  private $request;

  protected static $defaultName = 'api:get-weather';

  protected static $defaultDescription = 'Get weather data from the provided service provider.';

  public function __construct(Request $request)
  {
    $this->request = $request;
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

    $arg1 = $input->getArgument('city');
    $arg2 = $input->getArgument('country');

    $weatherProvider = Weather::getProvider($input->getArgument('provider') ?: 'openweather');
    $weatherProvider->makeRequest($this->request, $arg1, $arg2);
    var_dump($weatherProvider->getTemp());

    if ($arg1) {
      $io->note(sprintf('You passed an argument: %s', $arg1));
    }

    $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

    return Command::SUCCESS;
  }
}
