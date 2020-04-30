<?php

namespace SofiB\Infrastructure;

use Psr\Log\LoggerInterface;

class LoggerEventStream implements EventStream
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function emit(Event $event): void
    {
        $this->logger->info(sprintf('Received %s %s', get_class($event), $event->getName()));
        $this->logger->info(sprintf('Event data %s', $event->getPayload()));
    }
}
