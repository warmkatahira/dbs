<?php

namespace App\Http\Controllers\SalesPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\SalesPlan;
// サービス
use App\Services\SalesPlan\SalesPlanDeleteService;

class SalesPlanDeleteController extends Controller
{
    public function delete(Request $request)
    {
        // インスタンス化
        $SalesPlanDeleteService = new SalesPlanDeleteService;
        // 売上計画を削除
        $SalesPlanDeleteService->deleteSalesPlan($request->sales_plan_id);
        return back()->with([
            'alert_type' => 'success',
            'alert_message' => '売上計画の削除が完了しました。',
        ]);
    }
}
