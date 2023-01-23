<?php

namespace App\Http\Repository;

use App\Models\CryptoCurrencyRequest;
use Illuminate\Http\Request;

class CoinMarketCapRepository
{
    private string $request;

    public function __construct($request)
    {
        $this->request = $request;
//        var_dump($this->request);die;
    }

    public function getData(): array
    {
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
        $parameters = [
            'symbol' => $this->request  ,
            'convert' => 'EUR'
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY:' . $_ENV["API_KEY"]
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
// Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        $cryptoData = (json_decode($response)); // print json decoded response
        curl_close($curl); // Close request
        $crypt = [];
        foreach ($cryptoData->data as  $crypto) {
            $crypt[] = new CryptoCurrencyRequest(
                $crypto->id,
                $crypto->name,
                $crypto->symbol,
                $crypto->quote->EUR->price,
                $crypto->quote->EUR->percent_change_1h,
                $crypto->quote->EUR->percent_change_24h,
                $crypto->quote->EUR->percent_change_7d,
            );}

        var_dump($cryptoData);die;
        return $crypt;
    }
}
