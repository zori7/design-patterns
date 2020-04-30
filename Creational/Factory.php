<?php

interface Vehicle {
    public function drive();
}

class Bike implements Vehicle {
    public function drive() {
        echo 'driving bike' . PHP_EOL;
    }
}

class Car implements Vehicle {
    public function drive() {
        echo 'driving car' . PHP_EOL;
    }
}

abstract class VehicleSchool {
    abstract protected function createVehicle(): Vehicle;

    public function teach() {
        $v = static::createVehicle();

        $v->drive();
    }
}

class BikeSchool extends VehicleSchool {
    protected function createVehicle(): Vehicle {
        return new Bike();
    }
}

class CarSchool extends VehicleSchool {
    protected function createVehicle(): Vehicle {
        return new Car();
    }
}

$bikeSchool = new BikeSchool();

$bikeSchool->teach();

$carSchool = new CarSchool();

$carSchool->teach();
