<?php

namespace App\Http\Requests;

use App\Http\Controllers\Session;
use App\Models\Account;
use App\Models\UserCard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceTransferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        $DBUserCodes = UserCard::where('user_id', Auth::id())->first()->user_code;
        $DBcode = explode(" ", $DBUserCodes);
        $fromAccount = Account::findOrFail($request->get('from_account'));
        return [
            'from_account' => [
                'required',
            ],
            'to_account' => [
                'required',
                'exists:accounts,number',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                'max:' . $fromAccount->balance / 100,
            ],
            'keycard' => [
                'required',
                'numeric',
                'digits:4',
                'in:' . $DBcode[Session::getData("rand")],
            ],
            ];
    }
}
