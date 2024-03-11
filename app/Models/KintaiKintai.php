<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// その他
use Illuminate\Support\Facades\DB;

class KintaiKintai extends Model
{
    use HasFactory;
    // 接続するDBをセット
    protected $connection = 'kintai';
    // 接続するテーブルをセット
    protected $table = 'kintais';
    // DB:kintaiのkintai_detailsテーブルとのリレーション
    public function kintai_kintai_details()
    {
        return $this->hasMany(KintaiKintaiDetail::class, 'kintai_id', 'kintai_id');
    }
    // 指定した日付の荷主稼働時間を従業員区分毎に集計して取得
    public static function getCustomerWorkingTimeByEmployeeCategoryId($work_day)
    {
        return self::where('work_day', $work_day)
                ->join('employees', 'employees.employee_id', 'kintais.employee_id')
                ->join('kintai_details', 'kintai_details.kintai_id', 'kintais.kintai_id')
                ->where('is_supported', 0)
                ->select('employee_category_id', 'customer_id', DB::raw('SUM(customer_working_time) as total_customer_working_time'))
                ->groupBy('customer_id', 'employee_category_id');
    }
}
