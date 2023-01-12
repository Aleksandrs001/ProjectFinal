<?php

namespace App\Http\Controllers;

use App\Models\AccHistory;
use App\Models\TransactionControllerRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionHistoryController extends Controller
{
    public function showForm(): View
    {

        $accountHistory = AccHistory::where('user_id', Auth::id())->latest()->get();
        $userHistory = [];
        foreach ($accountHistory as $history) {
            $userHistory []= new TransactionControllerRequest(
                $history->user_id,
                $history->history,
                $history->created_at,
                $history->transferred_from,
                $history->transferred_to,
            );
        }
        return view('transactionHistory', [
            'userHistory' => $userHistory,
        ]);
    }
}
