<?php

namespace App\Models;


class CryptoCurrencyRequest
{
    public string $id;
    public string $name;
    public string $symbol;
    public string $price;
    public string $priceChange1h;
    public string $priceChange24h;
    public string $priceChange7d;

    public function __construct(string $id,
                                string $name,
                                string $symbol,
                                string $price,
                                string $priceChange1h,
                                string $priceChange24h,
                                string $priceChange7d,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->price = $price;
        $this->priceChange1h = $priceChange1h;
        $this->priceChange24h = $priceChange24h;
        $this->priceChange7d = $priceChange7d;
    }
    public function getSymbol(): string
    {
        return $this->symbol;
    }
    public function getPrice(): string
    {
        return $this->price;
    }
    public function getId(): string
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPriceChange1h(): string
    {
        return $this->priceChange1h;
    }
    public function getPriceChange7d(): string
    {
        return $this->priceChange7d;
    }
    public function getPriceChange24h(): string
    {
        return $this->priceChange24h;
    }
}
