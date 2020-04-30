<?php

namespace SofiB\Business\Event;

use SofiB\Infrastructure\Event;

abstract class AbstractEvent implements Event
{
    private $name;
    private $payload;
    public function __construct(string $name, array $payload)
    {
        $this->name = $name;
        $this->payload = $payload;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPayload(): string
    {
        return json_encode($this->payload);
    }
}
