<?php

class Redis {
    private static $instance;

    private $port;

    private function __construct($port)
    {
        $this->port = $port;
    }

    private function __clone() { } // prevent public cloning

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): self
    {
        if (self::$instance === null)
            self::$instance = new self(6379);

        return self::$instance;
    }
}

// $instance = new Redis(); cannot do this

$instance = Redis::getInstance();

$instance2 = Redis::getInstance();

var_dump($instance); // redis instance
var_dump($instance2); // the same redis instance
