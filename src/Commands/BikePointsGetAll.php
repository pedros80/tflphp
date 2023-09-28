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

final class BikePointsGetAll extends Command
{
    protected static $defaultName        = 'bikePoints:getAll';
    protected static $defaultDescription = 'Get All Bike Points';

    private ServiceFactory $factory;

    public function configure(): void
    {
        $this->addArgument('apiKey', InputArgument::REQUIRED, 'Your Api Key');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->factory = new ServiceFactory();
        /** @var TfLBikePointService $service */
        $service = $this->factory->makeService(ServiceFactory::BIKE_POINT, $input->getArgument('apiKey'));

        $bikePoints = $service->getAll();

        $output->writeln(json_encode($bikePoints));

        return Command::SUCCESS;
    }
}
