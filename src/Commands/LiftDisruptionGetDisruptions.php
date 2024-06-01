<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Commands;

use Pedros80\TfLphp\Factories\ServiceFactory;
use Pedros80\TfLphp\Services\TfLLiftDisruptionService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Safe\json_encode;

final class LiftDisruptionGetDisruptions extends Command
{
    protected static $defaultName        = 'liftDisruption:getDisruption';
    protected static $defaultDescription = 'Get Current Lift Disruptions';

    private ServiceFactory $factory;

    public function __construct()
    {
        parent::__construct('liftDisruption:getDisruption');
    }

    public function configure(): void
    {
        $this->addArgument('apiKey', InputArgument::REQUIRED, 'Your Api Key');
        $this->addArgument('v1', InputArgument::OPTIONAL, 'Use v1 api?');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->factory = new ServiceFactory();
        /** @var TfLLiftDisruptionService $service */
        $service = $this->factory->makeService(ServiceFactory::LIFT_DISRUPTION, $input->getArgument('apiKey'));

        $v1 = (bool) $input->getArgument('v1');

        $disruptions = $service->getDisruptions($v1);

        $output->writeln(json_encode($disruptions));

        return Command::SUCCESS;
    }
}
