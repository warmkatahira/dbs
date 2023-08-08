<?php

namespace App\Http\Controllers\MasterMgt\Base\SalesPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\SalesPlan;
// サービス
use App\Services\MasterMgt\Base\SalesPlan\SalesPlanUpdateService;
// その他
use Illuminate\Support\Facades\DB;

class SalesPlanUpdateController extends Controller
{
    public function index(Request $request)
    {
        // 売上計画IDをセッションにセット
        session(['sales_plan_id' => $request->sales_plan_id]);
        // 売上計画を取得
        $sales_plan = SalesPlan::getSpecify($request->sales_plan_id)->first();
        return view('master_mgt.base.sales_plan.update')->with([
            'sales_plan' => $sales_plan,
        ]);
    }

    public function update(Request $request)
    {
        // インスタンス化
        $SalesPlanUpdateService = new SalesPlanUpdateService;
        // 
        $SalesPlanUpdateService->updateSalesPlan($request);
        return back()->with([
            'alert_type' => 'success',
            'alert_message' => '売上計画の更新が完了しました。',
        ]);
    }
}
