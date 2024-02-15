<?php

namespace App\Http\Controllers\Setting\MonthlyCustomerSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// モデル
use App\Models\Base;
use App\Models\MonthlyCustomerSetting;
// サービス
use App\Services\Setting\MonthlyCustomerSetting\MonthlyCustomerSettingCreateRecordService;
// その他
use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;

class MonthlyCustomerSettingCreateRecordController extends Controller
{
    public function create(Request $request)
    {
        // インスタンス化
        $MonthlyCustomerSettingCreateRecordService = new MonthlyCustomerSettingCreateRecordService;
        try {
            $result = DB::transaction(function () use ($request, $MonthlyCustomerSettingCreateRecordService) {
                // 年月をフォーマット
                $create_ym = CarbonImmutable::createFromFormat('Y-m', $request->create_ym)->startOfMonth();
                // 有効な荷主を取得
                $customers = $MonthlyCustomerSettingCreateRecordService->getAvailableCustomer($request->base_id);
                // 追加する設定行の情報を取得
                $create_records = $MonthlyCustomerSettingCreateRecordService->getCreateRecordInfo($request->base_id, $create_ym, $customers);
                // 情報が無ければ追加する設定行がないので、処理を中断
                if ($create_records->count() == 0) {
                    throw new \Exception('追加できる設定行がありません。');
                }
                // 設定行を追加
                $MonthlyCustomerSettingCreateRecordService->createRecord($create_ym, $create_records);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'alert_type' => 'error',
                'alert_message' => $e->getMessage(),
            ]);
        }
        return redirect()->back()->with([
            'alert_type' => 'success',
            'alert_message' => '以下の設定行を追加しました。<br>'.
                                '拠点：'.Base::getSpecify($request->base_id)->first()->base_name.'<br>'.
                                '設定年月：'.CarbonImmutable::parse($request->create_ym)->format('Y年m月'),
        ]);
    }
}
