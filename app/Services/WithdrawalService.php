<?php

namespace App\Services;

use App\Models\{User,Transaction};
use Illuminate\Support\Facades\DB;

class WithdrawalService {

    public function withdrawal(array $data){
        try {
            $fees = 0;
    
            if(auth()->user()->account_type == 'individual'){
               
                $withdrawals = Transaction::where('user_id', auth()->user()->id )
                                ->where('transaction_type','withdrawal')
                                ->whereYear('date', now()->year)
                                ->whereMonth('date', now()->month)
                                ->sum('amount');
                $withdrawals = $withdrawals + $data['amount'];
    
                // Friday
    
                if($withdrawals  > 5000 && $data['amount'] > 1000 && now()->format('l') != 'Friday'){
                    $fees = $data['amount']; - 1000;
                    $fees = $fees*0.015;
                    $fees = $fees/100;
                }
    
            }else{
               
                $withdrawals = Transaction::where('user_id', auth()->user()->id )
                                ->where('transaction_type','withdrawal')
                                ->sum('amount');
    
                if($withdrawals > 50000){
                    $fees = $data['amount']*0.015;
                    $fees = $fees/100;
                }else{
                    $fees = $data['amount']*0.025;
                    $fees = $fees/100;
                }
               
            }
    
            Transaction::create([
                'user_id' => auth()->user()->id,
                'transaction_type' => 'withdrawal',
                'amount' => $data['amount'],
                'fee' => $fees,
                'date' => now()
                ]);
            
            User::where('id',auth()->user()->id)
                ->update([
                        'balance' => auth()->user()->balance - ($data['amount']+$fees),
                    ]);
            
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
    }
}