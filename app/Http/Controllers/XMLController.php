<?php

namespace App\Http\Controllers;


use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class XMLController extends Controller
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
