<?php

declare(strict_types=1);

namespace SofiB\Business\Vehicle;

interface VehicleReadRepository
{
    public function get(VehicleIdentifier $id): ?Vehicle;
    /**
     * @param array $filters // TODO have a filters collection
     * @return \Traversable<Vehicle>
     */
    public function list(array $filters): \Traversable;
}
