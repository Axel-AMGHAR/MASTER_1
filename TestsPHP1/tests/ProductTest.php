<?php

namespace App\Tests;

use App\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    /**
     * @dataProvider getProductFood
     * @param Product $product
     * @param float $expected
     */
    public function testProductFood(Product $product, float $expected)
    {
        $res = $product->computeTva();

        $this->assertSame($expected, $res);
    }

    public function getProductFood()
    {
        return [
            [new Product('banane', Product::FOOD_PRODUCT, 10), 0.55 ],
            [new Product('vodka', 'boisson' , 10), 1.96],
        ];
    }

    public function testTvaWithNegativePrice()
    {
        $product = new Product('product', 'type', -1);

        $this->expectException('LogicException');

        $res = $product->computeTva();
    }
}