<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $type =  auth()->user()->account_type;
        $balance =  auth()->user()->balance;

        $transactions = Transaction::where('user_id', $user_id )
                                ->orderBy('created_at','DESC')
                                ->get();
                                
        return view('home',compact('transactions','balance','type'));
    }
}
