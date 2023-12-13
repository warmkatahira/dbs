<?php

namespace App\Http\Controllers\SalesPlan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
// サービス
use App\Services\SalesPlan\SalesPlanCreateService;
// リクエスト
use App\Http\Requests\SalesPlan\SalesPlanCreateRequest;

class SalesPlanCreateController extends Controller
{
    public function index(Request $request)
    {
        // 拠点を取得
        $base = Base::getSpecify(session('search_base_id'))->first();
        return view('sales_plan.create')->with([
            'base' => $base,
        ]);
    }

    public function create(SalesPlanCreateRequest $request)
    {
        // インスタンス化
        $SalesPlanCreateService = new SalesPlanCreateService;
        // 売上計画を登録
        $SalesPlanCreateService->createSalesPlan($request);
        return redirect(session('back_url_1'))->with([
            'alert_type' => 'success',
            'alert_message' => '売上計画の登録が完了しました。',
        ]);
    }
}
