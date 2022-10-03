<?php


namespace App\Services;


class Product
{

    private $price;
    private $name;
    /**
     * Product constructor.
     */
    public function __construct(int $price,$name)
    {
        $this->price = $price;
        $this->name = $name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
    public function getName()
    {
        return $this->name;
    }
}