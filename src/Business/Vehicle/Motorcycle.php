<?php

namespace SofiB\Business\Vehicle;

/**
 * Hardcoded values for simplicity.
 */
class Motorcycle implements Vehicle
{
  public function getWeight () : float {
    return 800; //kg
  }

  public function getDimensions () : array {
    return [80, 160, 30]; //cm
  }

  public function toArray () : array {
    return [ 'weight' => $this->getWeight(), 'dimensions' => $this->getDimensions()];
  }
}
