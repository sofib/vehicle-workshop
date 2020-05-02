#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;

$application = new Application();
/**
 * @var \Psr\Log\LoggerInterface $logger
 */
$logger = new ConsoleLogger(new ConsoleOutput());

$application->add(new \SofiB\Delivery\Console\WashCommand());
$application->add(new \SofiB\Delivery\Console\RepairCommand());
try {
    $application->run();
} catch (\Exception $exception) {
    $logger->critical('Unknown error: ' . $exception->getMessage(), ['exception' => $exception]);
}
