<?php

namespace App;

class Product
{

    /* @var string */
    CONST FOOD_PRODUCT = "food";

    /* @var string */
    private $name;
    /* @var string */
    private $price;
    /* @var float */
    private $type;

    public function __construct(string $name,string $type,float $price)
    {
        $this->type = $type;
        $this->name = $name;
        $this->price = $price;
    }

    public function computeTva() : float
    {
        if($this->price < 0){
            throw new \LogicException("price can't be negative");
        }

        if(self::FOOD_PRODUCT === $this->type)
            return $this->price * 0.055;

        return $this->price * 0.196;
    }

}