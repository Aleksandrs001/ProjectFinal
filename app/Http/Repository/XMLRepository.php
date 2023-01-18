<?php

namespace App\Http\Repository;

use App\Http\Controllers\Controller;

class XMLRepository extends Controller
{
    public function index()
    {
        $xmlString = file_get_contents('https://www.bank.lv/vk/ecb.xml');
        $xmlObject = simplexml_load_string($xmlString);
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);
        $currency = [];
        foreach ($phpArray['Currencies'] as $value) {
            $currency = $value;
        }
        return $currency;
    }
}
