<?php

declare(strict_types=1);

namespace Pedros80\Build\Commands;

use Pedros80\Build\Actions\GetStationDataFile;
use Pedros80\Build\Factories\ActionFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GetStationData extends Command
{
    protected static $defaultName        = 'build:getStationData';
    protected static $defaultDescription = 'Download Zip of current, detailed Station Data';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $actions = new ActionFactory();
        $action  = $actions->makeAction(GetStationDataFile::class);

        $action->execute();

        return Command::SUCCESS;
    }
}
