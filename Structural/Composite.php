<?php

interface Component {
    public function getPrice(): float;
}

class Item implements Component {
    protected $price;

    public function __construct($price)
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

class Box implements Component {
    protected $children;

    public function __construct()
    {
        $this->children = new \SplObjectStorage();
    }

    public function add(Component $component): void
    {
        $this->children->attach($component);
    }

    public function remove(Component $component): void
    {
        $this->children->detach($component);
    }

    public function getPrice(): float
    {
        return array_reduce(
            iterator_to_array($this->children),
            fn($carry, $item) => $carry + $item->getPrice(),
            0
        );
    }
}


$mainBox = new Box();

$item1 = new Item(5.24);
$item2 = new Item(2.23);
$mainBox->add($item1);
$mainBox->add($item2);

$box1 = new Box();
$item3 = new Item(3.5);
$box1->add($item3);

$mainBox->add($box1);

var_dump($mainBox->getPrice());
