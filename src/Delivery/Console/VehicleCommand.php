<?php

namespace SofiB\Delivery\Console;

use SofiB\Business\VehicleFactory;
use SofiB\Business\CarFactory;
use SofiB\Business\MotorcycleFactory;
use SofiB\Business\VehicleService;
use SofiB\Business\Vehicle\Vehicle;
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

    private const CAR = 'car';
    private const MOTOR = 'motor';

    private const VEHICLE_TYPE = 'vehicle-type';

    /**
     * @var VehicleFactory[]
     */
    private $vehicleFactoryMap;

    public function __construct(?string $name = null)
    {
        parent::__construct($name);
        $this->vehicleFactoryMap = [
            self::CAR => new CarFactory(),
            self::MOTOR => new MotorcycleFactory(),
        ];

    }

    public function configure()
    {
        $this->addOption(
            self::VEHICLE_TYPE,
            't',
            InputOption::VALUE_REQUIRED,
            'Type of the vehicle. Available ' . self::CAR . ',' . self::MOTOR
        );
    }

    protected abstract function vehicleAction (Vehicle $vehicle, VehicleService $service): float;
    
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $vehicleType = $input->getOption(self::VEHICLE_TYPE);
        if (!in_array($vehicleType, [self::CAR, self::MOTOR])) {
            $output->writeln('Invalid option vehicle type');
            return;
        }

        $output->writeln('=============================');
        $output->writeln(sprintf('Operation \'%s\' on a %s', static::$defaultName, $vehicleType));
        $output->writeln('=============================');

        $verbosityLevelMap = [
          LogLevel::INFO   => OutputInterface::VERBOSITY_NORMAL,
        ];

        $service = new VehicleService(new LoggerEventStream(new ConsoleLogger($output, $verbosityLevelMap)));
        $cost = $this->vehicleAction($this->vehicleFactoryMap[$vehicleType]->new(), $service);
        $output->writeln(sprintf('Please pay %.2f', $cost));

        $output->writeln('==============');
        $output->writeln('Done .........');
        $output->writeln('==============');
    }
}
