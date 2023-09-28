<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Commands;

use Pedros80\TfLphp\Factories\ServiceFactory;
use Pedros80\TfLphp\Services\TfLAccidentStatsService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class AccidentStatsGetDetails extends Command
{
    protected static $defaultName        = 'accidentStats:getDetails';
    protected static $defaultDescription = 'Get Stats on Accidents';

    private ServiceFactory $factory;


    public function configure(): void
    {
        $this->addArgument('apiKey', InputArgument::REQUIRED, 'Your Api Key');
        $this->addArgument('year', InputArgument::REQUIRED, 'Details from what year?');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->factory = new ServiceFactory();
        /** @var TfLAccidentStatsService $service */
        $service = $this->factory->makeService(ServiceFactory::ACCIDENT_STATS, $input->getArgument('apiKey'));

        $service->getDetails((int) $input->getArgument('year'));

        return Command::SUCCESS;
    }
}
