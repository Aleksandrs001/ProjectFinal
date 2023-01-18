<?php

namespace App\Models;

class CoinMarketRequest
{
    public string $userSymbol;
    public string $userValute;

    public function __construct(string $userSymbol, string $userValute)
    {

        $this->userSymbol = $userSymbol;
        $this->userValute = $userValute;
    }

    public function getUserSymbol(): string
    {
        return $this->userSymbol;
    }

    public function getUserValute(): string
    {
        return $this->userValute;
    }
}
