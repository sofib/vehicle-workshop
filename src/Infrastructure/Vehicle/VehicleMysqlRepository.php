<?php

namespace SofiB\Infrastructure\Vehicle;

use SofiB\Business\Vehicle\VehicleFactory;
use SofiB\Business\Vehicle\VehicleReadRepository;
use SofiB\Business\Vehicle\VehicleIdentifier;

abstract class VehicleMySqlRepository implements VehicleReadRepository
{
    private \PDO $pdo;
    private VehicleFactory $factory;

    protected const VEHICLE_TYPE = '';

    public function __construct(\PDO $pdo, VehicleFactory $factory)
    {
        $this->pdo = $pdo;
        $this->factory = $factory;
    }

    protected function getFactory(): VehicleFactory
    {
        return $this->factory;
    }

    public function get(VehicleIdentifier $id): ?\SofiB\Business\Vehicle\Vehicle
    {
        return null;
    }

    /**
     * @param array $filters // TODO have a filters collection
     * @return \Traversable<Vehicle>
     */
    public function list(array $filters): \Traversable
    {
        $sql = 'SELECT * FROM vehicle WHERE `type`=:type';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':type' => static::VEHICLE_TYPE]);
        
        $rows = $this->pdo->query($sql);
        foreach ($rows as $row) {
            yield $this->buildObject($row);
        }
    }

    protected abstract function buildObject(array $row): \SofiB\Business\Vehicle\Vehicle;
}