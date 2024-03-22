<?php

namespace App\Services\BalanceMgt\BalanceList;

// モデル
use App\Models\Balance;
// その他
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class ListService
{
    // 表示する情報をセッションに格納
    public function setDisplayInfo($request)
    {
        // nullなら検索が実行されていないので、初期条件をセット
        if(is_null($request->search_enter)){
            session(['search_balance_date_from' => CarbonImmutable::now()->firstOfMonth()->format('Y-m-d')]);
            session(['search_balance_date_to' => CarbonImmutable::now()->format('Y-m-d')]);
            session(['search_base_id' => Auth::user()->base_id]);
            session(['search_customer_id' => null]);
        }
        // nullではなかったら検索が実行されているので、指定された条件を格納
        if(!is_null($request->search_enter)){
            session(['search_balance_date_from' => is_null($request->search_balance_date_from) ? CarbonImmutable::now()->format('Y-m-d') : $request->search_balance_date_from]);
            session(['search_balance_date_to' => is_null($request->search_balance_date_to) ? CarbonImmutable::now()->format('Y-m-d') : $request->search_balance_date_to]);
            session(['search_month' => $request->search_month]);
            session(['search_base_id' => $request->search_base_id]);
            session(['search_customer_id' => $request->search_customer_id]);
        }
        return;
    }

    // リストに表示する情報を取得
    public function getListInfo()
    {
        // 現在のURLを取得
        session(['back_url_1' => url()->full()]);
        // 収支テーブルをセット(収支日の条件を適用)
        $balances = Balance::whereDate('balance_date', '>=', session('search_balance_date_from'))
                    ->whereDate('balance_date', '<=', session('search_balance_date_to'))
                    ->join('customers', 'customers.customer_id', 'balances.customer_id')
                    ->join('bases', 'bases.base_id', 'customers.base_id');
        // 拠点条件がある場合
        if(session('search_base_id') != null){
            $balances->where('customers.base_id', session('search_base_id'));
        }
        // 荷主条件がある場合
        if(session('search_customer_id') != null){
            $balances->where('balances.customer_id', session('search_customer_id'));
        }
        // 並び替えする
        return $balances->orderBy('balance_date', 'asc')->orderBy('customers.base_id', 'asc')->paginate(50);
    }
}