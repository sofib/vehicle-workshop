<?php

namespace SofiB\Business\Vehicle;

interface VehicleBuilder
{
    public function withId(VehicleIdentifier $id): VehicleBuilder;
    public function build(): Vehicle;
}