<?php

namespace SofiB\Business;

use SofiB\Business\Billing\Repair;
use SofiB\Business\Billing\Wash;
use SofiB\Business\Event\ServiceEnded;
use SofiB\Business\Event\ServiceStarted;
use SofiB\Business\Vehicle\Vehicle;
use SofiB\Infrastructure\EventStream;

/**
 * VehicleService class is not necessarily class that conforms to the Service coding paragidm,
 * but more of a self speaking name of it's purpose and that is to do a service on a vehicle (to a customer).
 * 
 * Given numbers and the use cases here are imaginably simplified to reduce the complexity that would otherwise grow.
 */
class VehicleService
{
    private $eventStream;
    public function __construct(EventStream $eventStream)
    {
        $this->eventStream = $eventStream;
    }

    public function wash(Vehicle $vehicle): float
    {
        $this->eventStream->emit(new ServiceStarted(__FUNCTION__, $vehicle->toArray()));

        $service = new Wash();
        $service->addWater(Wash::createWaterUsage($vehicle->getWeight() * 0.05));
        $service->addWork(Wash::createWork($this->calculateEffort($vehicle)));
        $cost = $service->getCost();

        $this->eventStream->emit(new ServiceEnded(__FUNCTION__, array_merge($vehicle->toArray(), ['cost' => $cost])));

        return $cost;
    }

    public function repair(Vehicle $vehicle): float
    {
        $this->eventStream->emit(
            new ServiceStarted(__FUNCTION__, $vehicle->toArray()));

        $service = new Repair();

        $service->addWork(Repair::createWork($this->calculateEffort($vehicle, 0.00021), 40.00, 'Oil exchange'));
        $service->addWork(Repair::createWork($this->calculateEffort($vehicle, 0.00018), 50.00, 'Installment'));
        $work = Repair::createWork($this->calculateEffort($vehicle, 0.00033), 125.00, 'Heavy repair');
        $work->addDiscount(250.00, 'coupon');
        $service->addWork($work);
        $cost = $service->getCost();

        $this->eventStream->emit(new ServiceEnded(__FUNCTION__, array_merge($vehicle->toArray(), ['cost' => $cost])));

        return $cost;
    }

    private function calculateEffort(Vehicle $vehicle, float $costIndex = 0.00015): float
    {
        $reduce = function (float $total, int $dim ) { $total *= $dim; return $total; };
        return array_reduce($vehicle->getDimensions(), $reduce, 1) * $costIndex;
    }
}
