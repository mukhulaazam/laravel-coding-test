<?php

namespace App\Http\Controllers;

use App\Models\{User,Transaction};
use App\Services\{DepositService,WithdrawalService};
use App\Http\Requests\{StoreTransactionRequest,WithdrawalStoreTransactionRequest};

class TransactionController extends Controller
{
    public function __construct(private DepositService $depositService, private WithdrawalService $withdrawalService)
    {
        $this->depositService = $depositService;
        $this->withdrawalService = $withdrawalService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deposits = Transaction::where('user_id', auth()->user()->id)
                                ->where('transaction_type','deposit')
                                ->latest('created_at')
                                ->get();
        return view('deposit', compact('deposits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $this->depositService->deposit($request->all());

        return redirect()->back()->with('message', 'Your Deposit Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function withdrawal()
    {

        $withdrawals = Transaction::where('user_id', auth()->user()->id)
                                ->where('transaction_type','withdrawal')
                                ->latest('created_at')
                                ->get();
                                
        return view('withdrawal',compact('withdrawals'));
    }

    public function withdrawalStore(WithdrawalStoreTransactionRequest $request)
    {
        $this->withdrawalService->withdrawal($request->all());
    
        return redirect()->back()->with('message', 'Your Withdrawal Successfully');
    }

}
