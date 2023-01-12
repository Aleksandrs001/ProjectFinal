<?php declare(strict_types=1);

namespace App\Http\Controllers\Repository;

use App\Models\CryptoCurrency;
use App\Models\CryptoCurrenciesCollection;

interface CryptoCurrenciesRepository
{
    public function fetchAllBySymbols(array $symbols): CryptoCurrenciesCollection;
    public function fetchBySymbol(string $symbol): CryptoCurrency;
    public function fetchQuote(string $symbol): Quote;
}
