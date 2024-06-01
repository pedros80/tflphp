<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Commands;

use Pedros80\TfLphp\Factories\ServiceFactory;
use Pedros80\TfLphp\Services\TfLAirQualityService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Safe\json_encode;

final class AirQualityGetFeed extends Command
{
    protected static $defaultName        = 'airQuality:getFeed';
    protected static $defaultDescription = 'Get Air Quality Feed';

    private ServiceFactory $factory;

    public function __construct()
    {
        parent::__construct('airQuality:getFeed');
    }

    public function configure(): void
    {
        $this->addArgument('apiKey', InputArgument::REQUIRED, 'Your Api Key');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->factory = new ServiceFactory();
        /** @var TfLAirQualityService $service */
        $service = $this->factory->makeService(ServiceFactory::AIR_QUALITY, $input->getArgument('apiKey'));

        $feed = $service->getFeed();

        $output->writeln(json_encode($feed));

        return Command::SUCCESS;
    }
}
