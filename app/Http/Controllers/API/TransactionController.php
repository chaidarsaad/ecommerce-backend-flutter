<?php

namespace App\Http\Controllers\API;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $status = $request->input('status');

        if ($id) {
            $transaction = Transaction::with(['items.product']);

            if ($transaction) {
                return ResponseFormatter::success([
                    $transaction,
                    'Data transaksi berhasil diambil'
                ]);
            } else {
                return ResponseFormatter::error([
                    null,
                    'Data transaksi tidak ada',
                    404
                ]);
            }
        }

        $transaction = Transaction::with(['ites.product'])->where('users_id', Auth::user()->id);

        if ($status) {
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success([
            $transaction->paginate($limit),
            'Data list transaksi berhasil diambil'
        ]);
    }
}