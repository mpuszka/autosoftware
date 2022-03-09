<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use App\Service\Weather;

class ApiGetWeatherCommand extends Command
{
  private $params = '';

  protected static $defaultName = 'api:get-weather';

  protected static $defaultDescription = 'Get weather data from the provided service provider.';

  public function __construct(ContainerBagInterface $params)
  {
    $this->params = $params;
    parent::__construct();
  }

  protected function configure(): void
  {
    $this->addArgument('provider', InputArgument::OPTIONAL, 'Argument description');
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $io = new SymfonyStyle($input, $output);

    $arg1 = $input->getArgument('provider');

    $weather = new Weather($input->getArgument('provider'));

    if ($arg1) {
      $io->note(sprintf('You passed an argument: %s', $arg1));
    }

    $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

    return Command::SUCCESS;
  }
}
