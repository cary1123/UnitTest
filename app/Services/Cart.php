<?php


namespace App\Services;


class Cart
{
    /**
     * @var Collection
     */
    private $items;

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        $this->items = collect();
    }

    public function add(Product $product) : void
    {
        $this->items->add($product);
    }

    public function count(): int
    {
        return $this->items->count();
    }

    public function totalAmount() : int
    {
        return $this->items->reduce(function ($carry, $item) {
            /**
             * @var int $carry
             * @var Product $item
             */
            return $carry + $item->getPrice();
        }, 0);
    }

    public function Discount()
    {
        $totalAmount = 0;

        foreach ($this->items as $item) {
           /**
                     * @var $item Product
                    */
            $totalAmount += $item->getPrice();
        }
       //$totalAmount >= 1000 ? $Discount = $totalAmount / 0.8 : $Discount = $totalAmount;


        return $totalAmount >= 1000 ? $totalAmount * 0.8 : $totalAmount;
    }

    public function Discount10off()
    {
        $totalAmount = 0;
        $name_array = [];
        foreach ($this->items as $item) {
            /**
             * @var $item Product
             */
            $name = $item->getName();
            $price = $item->getPrice();

            if (@$name_array["".$name.""]["count"] == ""){
                $name_array["".$name.""]["count"]= 0;
            }
            if (@$name_array["".$name.""]["totalAmount"] == "") {
                $name_array["".$name.""]["totalAmount"] = 0;
            }
            $name_array["".$name.""]["count"] += 1;
            $name_array["".$name.""]["totalAmount"] += $price;
        }
        foreach ($name_array as $key => $value) {
            $value["count"] == 2 ? $totalAmount += $value["totalAmount"] * 0.9 : $totalAmount += $value["totalAmount"];
        }



        return $totalAmount;
    }
}