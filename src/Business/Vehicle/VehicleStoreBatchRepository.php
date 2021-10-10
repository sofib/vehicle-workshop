<?php

declare(strict_types=1);

namespace SofiB\Business\Vehicle;

interface VehicleStoreBatchRepository
{
    /**
     * @param Vehicle[] $vehicle
     * @return void
     */
    public function store(array $vehicle): void;
}
