<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Repository\XMLRepository;
use App\Http\Requests\BalanceTransferRequest;
use App\Models\AccHistory;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BalanceTransferController extends Controller
{
    public function showForm(XMLRepository $currency): View
    {
//        Session::put("rand", rand(0, 9));
        $accounts = Account::where('user_id', Auth::id())->get();
        return view('balance-transfer', [
            'accounts' => $accounts,
            'currency' => $currency->index(),
            'code' => Session::getData("rand"),
        ]);
    }

    public function transfer(BalanceTransferRequest $request, XMLRepository $currency): RedirectResponse
    {
        Session::put("rand", rand(0, 9));

        $fromAccount = Account::findOrFail($request->get('from_account'));

        if ($fromAccount->user_id != Auth::id()) {
            return redirect()->back();
        }
        $toAccount = Account::where('number', $request->get('to_account'))->firstOrFail();
        $amount = $request->get('amount') * 100;
        $historyFrom = AccHistory::where('user_id', Auth::id())->first();
        $currency = $currency->index();
        $fromRate = [];
        foreach ($currency as $value) {
            $fromRate[$value['ID']] = $value['Rate'];
        }
        if ($fromAccount->valute == 'EUR' || $toAccount->valute == 'EUR') {
            $fromRate['EUR'] = 1;
        }
        $historyFrom->create([
            'user_id' => Auth::id(),
            'currency_symbol' => $fromAccount->valute,
            'history' => 'Transferred ' . $amount / 100 * $fromRate[$fromAccount->valute] .
                ' ' . $fromAccount->valute .
                ' from ' . $fromAccount->number .
                ' to ' . $toAccount->number,
            'transferred_from' => $fromAccount->number,
            'transferred_to' => $toAccount->number,
        ]);
        $fromAccount->update([
            'balance' => $fromAccount->balance - $amount * $fromRate[$fromAccount->valute],
        ]);
        $toAccount->update([
            'balance' => $toAccount->balance + $amount * $fromRate[$toAccount->valute],
        ]);
        $historyTo = AccHistory::where('user_id', Auth::id())->first();
        $historyTo->create([
            'user_id' => $toAccount->user_id,
            'currency_symbol' => $fromAccount->valute,
            'history' => 'Received ' . $amount / 100 * $fromRate[$toAccount->valute] .
                ' ' . $fromAccount->valute . ' from ' .
                $fromAccount->number . ' to ' . $toAccount->number,
            'transferred_from' => $fromAccount->number,
            'transferred_to' => $toAccount->number,
        ]);
        return redirect()->back();
    }
}
