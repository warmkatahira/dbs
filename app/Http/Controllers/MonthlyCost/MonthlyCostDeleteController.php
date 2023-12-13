<?php

namespace App\Http\Controllers\MonthlyCost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\MonthlyCost;
// サービス
use App\Services\MonthlyCost\MonthlyCostDeleteService;

class MonthlyCostDeleteController extends Controller
{
    public function delete(Request $request)
    {
        // インスタンス化
        $MonthlyCostDeleteService = new MonthlyCostDeleteService;
        // 月額経費を削除
        $MonthlyCostDeleteService->deleteMonthlyCost($request->monthly_cost_id);
        return back()->with([
            'alert_type' => 'success',
            'alert_message' => '月額経費の削除が完了しました。',
        ]);
    }
}
