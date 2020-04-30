<?php

interface NakedBike {
    public function drive(): void;
}

interface SportBike {
    public function drive(): void;
}

interface AbstractBikeFactory {
    public function createNaked(): NakedBike;
    public function createSport(): SportBike;
}


// Kawasaki

class KawasakiNakedBike implements NakedBike {
    public function drive(): void
    {
        echo 'driving Kawasaki naked!' . PHP_EOL;
    }
}

class KawasakiSportBike implements SportBike {
    public function drive(): void
    {
        echo 'driving Kawasaki sportbike!' . PHP_EOL;
    }
}

class KawasakiBikeFactory implements AbstractBikeFactory {
    public function createNaked(): NakedBike
    {
        return new KawasakiNakedBike();
    }

    public function createSport(): SportBike
    {
        return new KawasakiSportBike();
    }
}

// Suzuki

class SuzukiNakedBike implements NakedBike {
    public function drive(): void
    {
        echo 'driving Suzuki naked!' . PHP_EOL;
    }
}

class SuzukiSportBike implements SportBike {
    public function drive(): void
    {
        echo 'driving Suzuki sportbike!' . PHP_EOL;
    }
}

class SuzukiBikeFactory implements AbstractBikeFactory {
    public function createNaked(): NakedBike
    {
        return new SuzukiNakedBike();
    }

    public function createSport(): SportBike
    {
        return new SuzukiSportBike();
    }
}

// you can add other factories

$suzukiFactory = new SuzukiBikeFactory();
$suzukiNaked = $suzukiFactory->createNaked();
$suzukiNaked->drive();

$kawasakiFactory = new KawasakiBikeFactory();
$kawasakiSport = $kawasakiFactory->createSport();
$kawasakiSport->drive();
