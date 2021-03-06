<?php

namespace SofiB\Business\Vehicle;

interface Vehicle
{
  public function getWeight () : float;
  public function getDimensions () : array;
  public function toArray () : array;
}
