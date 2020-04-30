<?php

namespace SofiB\Business\Billing;

/**
 * A billable service
 */
interface Service
{
    public function getCost(): float;
}
