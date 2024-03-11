<?php

namespace App\Http\Controllers\BalanceMgt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル


class BalanceDetailController extends Controller
{
    public function index(Request $request)
    {
        
        return view('balance_mgt.balance_detail.index')->with([
        ]);
    }
}
