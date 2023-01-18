<?php

namespace App\Http\Controllers;

use App\Models\AccHistory;
use App\Models\TransactionControllerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionHistoryController extends Controller
{
    public function showForm(): View
    {
        $accountHistory = AccHistory::where('user_id', Auth::id())->latest()->paginate(10);
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
    public function showAll(): View
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
    public function showUserChoice(Request $request): View
    {
        $choiceUser=$request->get('user-choice') ?? 5;
        var_dump($choiceUser);
        $accountHistory = AccHistory::where('user_id', Auth::id())->latest()->paginate($choiceUser);
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
    public function showSearchByDate(Request $request)
    {
        $start_date=$request->get('start_date');
        $end_date=$request->get('end_date');
        $accountHistory = AccHistory::where('user_id', Auth::id())->whereBetween('created_at', [$start_date, $end_date])->get();
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
