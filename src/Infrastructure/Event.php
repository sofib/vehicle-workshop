<?php

namespace SofiB\Infrastructure;

interface Event
{
    public function getName(): string;
    public function getPayload(): string;
}
