<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;

class ReceiptController extends Controller
{
    public function store(Request $request)
    {
        // validasi: wajib ada file image
        $request->validate([
            'image' => 'required|image|max:4096',
            // nanti bisa tambah field lain (misal manual total, catatan, dll)
        ]);

        // simpan gambar ke storage/app/public/receipts
        $path = $request->file('image')->store('receipts', 'public');

        // nanti bagian ini akan diganti panggilan ke ML service
        // untuk sekarang kita buat dummy parsing
        $dummyParsed = [
            'store'      => 'DUMMY STORE',
            'date'       => now()->toDateString(),
            'total'      => 50000,
            'category'   => 'Groceries',
            'items'      => [
                ['name' => 'Item A', 'price' => 30000],
                ['name' => 'Item B', 'price' => 20000],
            ],
        ];

        // sementara user_id di-hardcode 1 (nanti pakai auth)
        $transaction = Transaction::create([
            'user_id'            => 1,
            'store_name'         => $dummyParsed['store'],
            'date'               => $dummyParsed['date'],
            'category'           => $dummyParsed['category'],
            'total_amount'       => $dummyParsed['total'],
            'items'              => $dummyParsed['items'],
            'receipt_image_path' => $path,
        ]);

        return response()->json([
            'message'     => 'Receipt processed (dummy)',
            'transaction' => $transaction,
        ], 201);
    }
}
