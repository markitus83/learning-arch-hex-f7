<?php

namespace Fut7\UserInterface\CLI\Command;

use Fut7\UserInterface\Controller\Season\CRUD\ViewSeasonController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewSeasonDataCommand extends Command
{
    protected static $defaultName = 'fut7:season:view-data';

    protected static $defaultDescription = 'Show season data stored in CSV file';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $controller = new ViewSeasonController();
        $controller->execute();

        return Command::SUCCESS;
    }
}