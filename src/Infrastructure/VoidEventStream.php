<?php

namespace SofiB\Infrastructure;

class VoidEventStream implements EventStream
{
    public function emit(Event $event): void
    {
        // does nothing
    }
}
