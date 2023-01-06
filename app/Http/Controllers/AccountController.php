<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    public function index(XMLController $currency)
    {
        $accounts = Account::where('user_id', Auth::id())->get();
        return view('dashboard',[
            'accounts' => $accounts,
            'currency' => $currency->index(),
        ]);
    }
    public function edit(Account $account)
    {
        $accounts = Account::where('user_id', Auth::id())->get();
                if($account->user_id != Auth::id()){
            abort(403);
        }
        return view('accounts.edit', [
            'account' => $account,
            'accounts' => $accounts,

        ]);
    }

    public function update(Account $account, Request $request)
    {
        if($account->user_id != Auth::id()){
            abort(403);
        }
        $account->update([
            'label' => $request->get('label'),
        ]);

        return redirect()->route('accounts.edit', $account);
    }
}
