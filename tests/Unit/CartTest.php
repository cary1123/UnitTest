<?php

namespace Tests\Unit;

use App\Services\Cart;
use App\Services\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testShouldReturnOneWhenAddOneProduct()
    {
        // arrange
        $target = new Cart();
        $product = new Product(100,"A");
        $expected = 1;

        // act
        $target->add($product);
        $actual = $target->count();

        //assert
        $this->assertEquals($expected, $actual);
    }

    /**
     *
     */
    public function testShouldReturn152WhenAddProduct100AndProduct52()
    {
        // arrange
        $target = new Cart();
        $product1 = new Product(100,"A");
        $product2 = new Product(52,"A");
        $expected = 152;

        // act
        $target->add($product1);
        $target->add($product2);
        $actual = $target->totalAmount();

        //assert
        $this->assertEquals($expected, $actual);
    }

    public function test1000to20off()
    {
        // arrange
        $target = new Cart();
        $product1 = new Product(500,"A");
        $product2 = new Product(500,"A");
        $expected = 800;

        // act
        $target->add($product1);
        $target->add($product2);
        $actual = $target->Discount();

        //assert
        $this->assertEquals($expected, $actual);
    }

    public function testSomeProduct10off()
    {
        // arrange
        $target = new Cart();
        $product1 = new Product(100,"A");
        $product2 = new Product(100,"A");
        $expected = 180;

        // act
        $target->add($product1);
        $target->add($product2);
        $actual = $target->Discount10off();

        //assert
        $this->assertEquals($expected, $actual);
    }
}
