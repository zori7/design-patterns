<?php

interface Builder {
    public function reset(): void;
    public function setSeats(int $number): void;
    public function setEnginePower(int $hp): void;
    public function setGPS(bool $gps): void;
    public function setSpoiler(bool $spoiler): void;
}

class CarBuilder implements Builder {
    private $car;

    public function reset(): void
    {
        $this->car = new Car();
    }

    public function setSeats(int $number): void
    {
        $this->car->seats = $number;
    }

    public function setEnginePower(int $hp): void
    {
        $this->car->enginePower = $hp;
    }

    public function setGPS(bool $gps): void
    {
        $this->car->GPS = $gps;
    }

    public function setSpoiler(bool $spoiler): void
    {
        $this->car->spoiler = $spoiler;
    }

    public function getResult(): Car
    {
        return $this->car;
    }
}

class Car {
    public $seats;
    public $enginePower;
    public $GPS;
    public $spoiler;
}

class Director {
    public function makeSUV(Builder $builder): void
    {
        $builder->reset();
        $builder->setSeats(5);
        $builder->setGPS(true);
        $builder->setEnginePower(180);
    }

    public function makeSportCar(Builder $builder): void
    {
        $builder->reset();
        $builder->setSeats(2);
        $builder->setEnginePower(340);
        $builder->setSpoiler(true);
    }
}

$director = new Director();
$builder = new CarBuilder();

$director->makeSUV($builder);
$suv = $builder->getResult();

$director->makeSportCar($builder);
$sportCar = $builder->getResult();

echo '$suv:' . PHP_EOL;
var_dump($suv);

echo '$sportCar:' . PHP_EOL;
var_dump($sportCar);
