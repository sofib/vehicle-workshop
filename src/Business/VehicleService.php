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
    private $vehicle;
    private $eventStream;
    private $persister;

    public function __construct(Vehicle $vehicle, EventStream $eventStream)
    {
        $this->vehicle = $vehicle;
        $this->eventStream = $eventStream;
    }

    public function wash(): float
    {
        $this->eventStream->emit(new ServiceStarted(__FUNCTION__, $this->vehicle->toArray()));

        $service = new Wash();
        $service->addWater(Wash::createWaterUsage($this->vehicle->getWeight() * 0.05));
        $service->addWork(Wash::createWork($this->calculateEffort($this->vehicle)));
        $cost = $service->getCost();

        $this->eventStream->emit(new ServiceEnded(__FUNCTION__, array_merge($this->vehicle->toArray(), ['cost' => $cost])));

        return $cost;
    }

    public function repair () : float
    {
        $this->eventStream->emit(
            new ServiceStarted(__FUNCTION__, $this->vehicle->toArray()));

        $service = new Repair();

        $service->addWork(Repair::createWork($this->calculateEffort($this->vehicle, 0.00021), 40.00, 'Oil exchange'));
        $service->addWork(Repair::createWork($this->calculateEffort($this->vehicle, 0.00018), 50.00, 'Installment'));
        $work = Repair::createWork($this->calculateEffort($this->vehicle, 0.00033), 125.00, 'Heavy repair');

        $work->addDiscount(250.00, 'coupon');
        $service->addWork($work);
        $cost = $service->getCost();

        $this->eventStream->emit(new ServiceEnded(__FUNCTION__, array_merge($this->vehicle->toArray(), ['cost' => $cost])));

        return $cost;
    }

    public function serve (Billing\Specs $specs)
    {
        # code...
    }

    public static function repairBuilder () : Billing\RepairBuilder
    {
        return new Billing\RepairBuilder();
    }

    private function calculateEffort(Vehicle $vehicle, float $costIndex = 0.00015): float
    {
        $reduce = function (float $total, int $dim ) { $total *= $dim; return $total; };
        return array_reduce($vehicle->getDimensions(), $reduce, 1) * $costIndex;
    }
}
