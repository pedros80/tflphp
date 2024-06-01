<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Commands;

use Pedros80\TfLphp\Factories\ServiceFactory;
use Pedros80\TfLphp\Services\TfLBikePointService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Safe\json_encode;

final class BikePointsSearch extends Command
{
    protected static $defaultName        = 'bikePoints:search';
    protected static $defaultDescription = 'Search Bike Points by Name';

    private ServiceFactory $factory;

    public function __construct()
    {
        parent::__construct('bikePoints:search');
    }

    public function configure(): void
    {
        $this->addArgument('apiKey', InputArgument::REQUIRED, 'Your Api Key');
        $this->addArgument('search', InputArgument::REQUIRED, 'Search Bike Points by name');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->factory = new ServiceFactory();
        /** @var TfLBikePointService $service */
        $service = $this->factory->makeService(ServiceFactory::BIKE_POINT, $input->getArgument('apiKey'));

        $bikePoints = $service->search($input->getArgument('search'));

        $output->writeln(json_encode($bikePoints));

        return Command::SUCCESS;
    }
}
