<?php

declare(strict_types=1);

namespace Pedros80\TfLphp\Build\Commands;

use Pedros80\TfLphp\Build\Actions\GenerateJourneyPlannerModes;
use Pedros80\TfLphp\Build\Actions\GenerateLine;
use Pedros80\TfLphp\Build\Actions\GenerateLineDisruptionCategories;
use Pedros80\TfLphp\Build\Actions\GenerateLineModes;
use Pedros80\TfLphp\Build\Actions\GenerateLineServiceTypes;
use Pedros80\TfLphp\Build\Actions\GeneratePlaceCategories;
use Pedros80\TfLphp\Build\Actions\GeneratePlaceTypes;
use Pedros80\TfLphp\Build\Actions\GenerateRailLines;
use Pedros80\TfLphp\Build\Actions\GenerateRoadDisruptionCategories;
use Pedros80\TfLphp\Build\Actions\GenerateRoadIds;
use Pedros80\TfLphp\Build\Actions\GenerateSeverityCodes;
use Pedros80\TfLphp\Build\Actions\GenerateStation;
use Pedros80\TfLphp\Build\Actions\GenerateStopPointInformationCategories;
use Pedros80\TfLphp\Build\Actions\GenerateStopPointModes;
use Pedros80\TfLphp\Build\Actions\GenerateStopPointTypes;
use Pedros80\TfLphp\Build\Factories\ActionFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class BuildClasses extends Command
{
    protected static $defaultName        = 'build:classes';
    protected static $defaultDescription = 'Generate enums and other classes';

    private ActionFactory $actions;

    public function __construct()
    {
        parent::__construct('build:classes');
    }

    public function configure(): void
    {
        $this->addArgument('apiKey', InputArgument::REQUIRED, 'Your Api Key');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->actions = new ActionFactory($input->getArgument('apiKey'));

        $actions = [
            GenerateJourneyPlannerModes::class,
            GenerateLine::class,
            GenerateLineDisruptionCategories::class,
            GenerateLineModes::class,
            GenerateLineServiceTypes::class,
            GeneratePlaceCategories::class,
            GeneratePlaceTypes::class,
            GenerateRailLines::class,
            GenerateRoadDisruptionCategories::class,
            GenerateRoadIds::class,
            GenerateSeverityCodes::class,
            GenerateStation::class,
            GenerateStopPointInformationCategories::class,
            GenerateStopPointModes::class,
            GenerateStopPointTypes::class,
        ];

        foreach ($actions as $class) {
            $action = $this->actions->makeAction($class);
            $action->execute();
        }

        return Command::SUCCESS;
    }
}
