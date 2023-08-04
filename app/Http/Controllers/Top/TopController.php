<?php

namespace App\Http\Controllers\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// その他
use Illuminate\Support\Facades\DB;

class TopController extends Controller
{
    public function index()
    {
        //dd(DB::connection('mysql_kintai')->table('bases')->get());
        return view('top')->with([
        ]);
    }
}
