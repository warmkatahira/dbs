<?php

namespace App\Http\Controllers\MonthlyCost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\MonthlyCost;
// サービス
use App\Services\MonthlyCost\MonthlyCostUpdateService;
// リクエスト
use App\Http\Requests\MonthlyCost\MonthlyCostUpdateRequest;

class MonthlyCostUpdateController extends Controller
{
    public function index(Request $request)
    {
        // 月額経費IDをセッションにセット
        session(['monthly_cost_id' => $request->monthly_cost_id]);
        // 月額経費を取得
        $monthly_cost = MonthlyCost::getSpecify($request->monthly_cost_id)->first();
        return view('monthly_cost.update')->with([
            'monthly_cost' => $monthly_cost,
        ]);
    }

    public function update(MonthlyCostUpdateRequest $request)
    {
        // インスタンス化
        $MonthlyCostUpdateService = new MonthlyCostUpdateService;
        // 月額経費を更新
        $MonthlyCostUpdateService->updateMonthlyCost($request);
        return redirect(session('back_url_1'))->with([
            'alert_type' => 'success',
            'alert_message' => '月額経費の更新が完了しました。',
        ]);
    }
}
