<?php

namespace App\Http\Controllers;

use App\Models\CryptoCurrencyRequest;
use Illuminate\Http\Request;


class CryptoCyrrencyController extends Controller
{

    public function getData(Request $request)
    {
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
        $parameters = [
            'symbol' => $request->get('search') ?? 'BTC,ETH,XRP,BCH,USDT,LTC,EOS,BNB,BSV,TRX',
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
//        echo '<pre>';
//var_dump($crypt);
 return view('/crypto', [
        'crypt' => $crypt,
    ]);
    }
}







