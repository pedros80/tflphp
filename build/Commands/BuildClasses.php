<?php

declare(strict_types=1);

namespace Pedros80\Build\Commands;

use Pedros80\Build\Actions\GenerateJourneyPlannerModes;
use Pedros80\Build\Actions\GenerateLineDisruptionCategories;
use Pedros80\Build\Actions\GenerateLineModes;
use Pedros80\Build\Actions\GenerateLines;
use Pedros80\Build\Actions\GenerateLineServiceTypes;
use Pedros80\Build\Actions\GeneratePlaceCategories;
use Pedros80\Build\Actions\GeneratePlaceTypes;
use Pedros80\Build\Actions\GenerateRoadDisruptionCategories;
use Pedros80\Build\Actions\GenerateSeverityCodes;
use Pedros80\Build\Actions\GenerateStation;
use Pedros80\Build\Actions\GenerateStopPointInformationCategories;
use Pedros80\Build\Actions\GenerateStopPointModes;
use Pedros80\Build\Actions\GenerateStopPointTypes;
use Pedros80\Build\Factories\ActionFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class BuildClasses extends Command
{
    protected static $defaultName        = 'build:classes';
    protected static $defaultDescription = 'Generate enums and other classes';

    private ActionFactory $actions;

    public function configure(): void
    {
        $this->addArgument('apiKey', InputArgument::REQUIRED, 'Your Api Key');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->actions = new ActionFactory($input->getArgument('apiKey'));

        $actions = [
            GenerateStopPointInformationCategories::class,
            GenerateStopPointModes::class,
            GenerateStopPointTypes::class,
            GenerateJourneyPlannerModes::class,
            GenerateLineDisruptionCategories::class,
            GenerateLineModes::class,
            GenerateLineServiceTypes::class,
            GenerateSeverityCodes::class,
            GenerateLines::class,
            GenerateStation::class,
            GeneratePlaceTypes::class,
            GeneratePlaceCategories::class,
            GenerateRoadDisruptionCategories::class,
        ];

        foreach ($actions as $class) {
            $action = $this->actions->makeAction($class);
            $action->execute();
        }

        return Command::SUCCESS;
    }
}
