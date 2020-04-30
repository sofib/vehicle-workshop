<?php

namespace SofiB\Infrastructure;

interface EventStream
{
    public function emit(Event $event): void;
}
