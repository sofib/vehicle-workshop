<?php

namespace SofiB\Delivery\Console;

use SofiB\Business\VehicleRoot;
use SofiB\Infrastructure\LoggerEventStream;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Log\LogLevel;

abstract class VehicleCommand extends Command
{
    protected static $defaultName = 'repair';

    private const VEHICLE_TYPE = 'vehicle-type';

    public function __construct(?string $name = null)
    {
        parent::__construct($name);
    }

    public function configure()
    {
        $this->addOption(
            self::VEHICLE_TYPE,
            't',
            InputOption::VALUE_REQUIRED,
            'Type of the vehicle. Available ' . implode(',', VehicleRoot::getValidVehicleTypes())
        );
    }

    protected abstract function vehicleAction (VehicleRoot $vehicle): float;
    
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $vehicleType = $input->getOption(self::VEHICLE_TYPE);
        if (!in_array($vehicleType, VehicleRoot::getValidVehicleTypes())) {
            $output->writeln('Invalid option vehicle type');
            return;
        }

        $output->writeln('=============================');
        $output->writeln(sprintf('Operation \'%s\' on a %s', static::$defaultName, $vehicleType));
        $output->writeln('=============================');

        $verbosityLevelMap = [
          LogLevel::INFO   => OutputInterface::VERBOSITY_NORMAL,
        ];

        // $service = new VehicleService(new LoggerEventStream(new ConsoleLogger($output, $verbosityLevelMap)));
        // $cost = $this->vehicleAction($this->vehicleFactoryMap[$vehicleType]->new(), $service);
        $root = VehicleRoot::serveVehicle(VehicleRoot::createVehicleFromType($vehicleType), new LoggerEventStream(new ConsoleLogger($output, $verbosityLevelMap)));
        $cost = $this->vehicleAction($root);
        $output->writeln(sprintf('Please pay %.2f', $cost));

        $output->writeln('==============');
        $output->writeln('Done .........');
        $output->writeln('==============');
    }
}
