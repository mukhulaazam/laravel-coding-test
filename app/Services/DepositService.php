<?php

namespace App\Services;

use App\Models\{User,Transaction};
use Illuminate\Support\Facades\DB;

class DepositService {

    public function deposit(array $data){
        try {
            DB::beginTransaction();
    
            $transaction = Transaction::create([
                'user_id' => auth()->user()->id,
                'amount' => $data['amount'],
                'transaction_type' => 'deposit',
                'date' => now(),
            ]);
    
            if ($transaction) {
                User::where('id', auth()->user()->id)
                    ->update([
                        'balance' => auth()->user()->balance + $data['amount'],
                    ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}