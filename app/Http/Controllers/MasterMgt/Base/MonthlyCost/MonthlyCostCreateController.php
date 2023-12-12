<?php

namespace App\Http\Controllers\MasterMgt\Base\MonthlyCost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
use App\Models\MonthlyItem;
// サービス
use App\Services\MasterMgt\Base\MonthlyCost\MonthlyCostCreateService;
// 列挙
use App\Enums\MonthlyItemEnum;
// リクエスト
use App\Http\Requests\MasterMgt\MonthlyCost\MonthlyCostCreateRequest;

class MonthlyCostCreateController extends Controller
{
    public function index(Request $request)
    {
        // 拠点を取得
        $base = Base::getSpecify(session('search_base_id'))->first();
        // 経費項目を全て取得
        $monthly_items = MonthlyItem::getSpecifyByItemCategory1(MonthlyItemEnum::COST_JP)->get();
        return view('master_mgt.base.monthly_cost.create')->with([
            'base' => $base,
            'monthly_items' => $monthly_items,
        ]);
    }

    public function create(MonthlyCostCreateRequest $request)
    {
        // インスタンス化
        $MonthlyCostCreateService = new MonthlyCostCreateService;
        // 月額経費を登録
        $MonthlyCostCreateService->createMonthlyCost($request);
        return redirect(session('back_url_1'))->with([
            'alert_type' => 'success',
            'alert_message' => '月額経費の登録が完了しました。',
        ]);
    }
}
