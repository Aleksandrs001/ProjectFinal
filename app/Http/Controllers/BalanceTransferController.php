<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Repository\XMLRepository;
use App\Models\Account;
use App\Models\UserCard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BalanceTransferController extends Controller
{

    public function showForm(XMLRepository $currency): View
    {
        $currency = $currency->index();
        $accounts = Account::where('user_id', Auth::id())->get();
        return view('balance-transfer', [
            'accounts' => $accounts,
            'currency' => $currency,
            'code' => Session::getData("rand"),
        ]);
    }

    public function transfer(Request $request): RedirectResponse
    {
        $DBUserCodes = UserCard::where('user_id', Auth::id())->first()->user_code;
        $DBcode = explode(" ", $DBUserCodes);
        $PostUserCode = $request['keycard'];
        Session::put("rand", rand(0, 4));

        $fromAccount = Account::findOrFail($request->get('from_account'));

        if ($fromAccount->user_id != Auth::id() ||
            $PostUserCode != $DBcode[Session::getData("rand")]) {
            return redirect()->back();
        }
        $toAccount = Account::where('number', $request->get('to_account'))->firstOrFail();
        $amount = $request->get('amount') * 100;

        $fromAccount->update([
            'balance' => $fromAccount->balance - $amount,
        ]);
        $toAccount->update([
            'balance' => $toAccount->balance + $amount,
        ]);
        return redirect()->back();


    }
}
