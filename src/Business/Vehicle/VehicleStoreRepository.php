<?php

declare(strict_types=1);

namespace SofiB\Business\Vehicle;

interface VehicleStoreRepository
{
    public function store(Vehicle $vehicle): void;
}
