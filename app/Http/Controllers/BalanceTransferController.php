<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BalanceTransferController extends Controller
{
    public function showForm(XMLController $currency): View
    {
        $currency = $currency->index();
        $accounts = Account::where('user_id', Auth::id())->get();

        return view('balance-transfer', [
            'accounts' => $accounts,
            'currency' => $currency,
        ]);
    }

    public function transfer( Request $request):RedirectResponse
    {
        $fromAccount = Account::findOrFail($request->get('from_account'));

        if ($fromAccount->user_id != Auth::id()){
            abort(403);
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
