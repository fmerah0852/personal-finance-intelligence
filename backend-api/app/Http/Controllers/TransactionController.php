<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // nanti bisa filter by user_id, date range, dsb
        $transactions = Transaction::orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        return response()->json($transactions);
    }
}
