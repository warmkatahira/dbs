<?php

namespace App\Http\Controllers\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Customer;
use App\Models\KintaiCustomer;
// その他
use Illuminate\Support\Facades\DB;

class TopController extends Controller
{
    public function index()
    {
        

        return view('top')->with([
        ]);
    }
}
