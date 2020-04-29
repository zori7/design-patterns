<?php

abstract class Device {
    public $screenSize;
    public $releaseDate;

    public function __construct($screenSize, $releaseDate)
    {
        $this->screenSize = $screenSize;
        $this->releaseDate = $releaseDate;
    }

    abstract public function __clone();
}

class SmartPhone extends Device {
    public $cellular;

    public function __construct($screenSize, $releaseDate, $cellular)
    {
        parent::__construct($screenSize, $releaseDate);
        $this->cellular = $cellular;
    }

    public function __clone()
    {
        $this->releaseDate = clone $this->releaseDate;
    }
}

$smartPhone1 = new SmartPhone('720x1280', new \DateTime(), '4G');

$smartPhone2 = clone $smartPhone1;

var_dump($smartPhone1);

$smartPhone2->screenSize = '1080x1920';
$smartPhone2->cellular = '5G';
$smartPhone2->releaseDate->add(new \DateInterval('P10D'));

var_dump($smartPhone2);
