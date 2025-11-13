<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TransactionController;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// untuk tahap awal belum pakai auth dulu
Route::post('/receipts', [ReceiptController::class, 'store']);       // upload struk
Route::get('/transactions', [TransactionController::class, 'index']); // list transaksi
