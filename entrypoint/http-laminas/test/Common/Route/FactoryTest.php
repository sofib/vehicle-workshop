<?php

namespace SofiB\Delivery\Common\Route;

use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
  public function testPushAndPop()
  {
      $_REQUEST['REQUEST_PATH'] = '/lskslkjfkllk/fslkhsdfkfds/sdfjkdsjdsf';
      $this->assertSame([], Factory::fromRequest('dsf'));
  }
}