<?php

namespace App\Http\Controllers\MasterMgt\Base\SalesPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\MasterMgt\Base\SalesPlan\SalesPlanCreateService;
// その他
use Illuminate\Support\Facades\DB;

class SalesPlanCreateController extends Controller
{
    public function index(Request $request)
    {
        // 拠点を取得
        $base = Base::getSpecify(session('search_base_id'))->first();
        return view('master_mgt.base.sales_plan.create')->with([
            'base' => $base,
        ]);
    }

    public function create(Request $request)
    {
        // インスタンス化
        $SalesPlanCreateService = new SalesPlanCreateService;
        // 売上計画を登録
        $SalesPlanCreateService->createSalesPlan($request);
        return back()->with([
            'alert_type' => 'success',
            'alert_message' => '売上計画の登録が完了しました。',
        ]);
    }
}
