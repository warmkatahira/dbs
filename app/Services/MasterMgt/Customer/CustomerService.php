<?php

namespace App\Services\MasterMgt\Customer;

// モデル
use App\Models\Customer;
// その他
use Illuminate\Support\Facades\Auth;
use App\Enums\BooleanEnum;

class CustomerService
{
    // 検索条件のセッションを削除
    public function deleteSearchSession()
    {
        session()->forget([
            'search_base_id',
            'search_customer_name',
            'search_is_available',
        ]);
        return;
    }

    // 検索条件の初期条件をセット
    public function setDefaultCondition($search_enter)
    {
        // nullなら検索が実行されていないので、初期条件をセット
        if(is_null($search_enter)){
            session(['search_base_id' => Auth::user()->base_id]);
            session(['search_is_available' => BooleanEnum::AVAILABLE]);
        }
        return;
    }

    // 検索条件をセッションにセット
    public function setSearchCondition($request)
    {
        // trueなら検索が実行されているので、検索条件をセット
        if($request->search_enter){
            session(['search_base_id' => $request->search_base_id]);
            session(['search_customer_name' => $request->search_customer_name]);
            session(['search_is_available' => $request->search_is_available]);
        }
        return;
    }

    // 荷主情報を取得
    public function getCustomerSearch()
    {
        // 現在のURLを取得
        session(['back_url_1' => url()->full()]);
        // 荷主をセット
        $customers = Customer::query();
        // 拠点条件がある場合
        if(session('search_base_id') != null){
            $customers->where('base_id', session('search_base_id'));
        }
        // 荷主名条件がある場合
        if(session('search_customer_name') != null){
            $customers->where('customer_name', 'LIKE', '%'.session('search_customer_name').'%');
        }
        // 有効/無効条件がある場合
        if(session('search_is_available') != null){
            $customers->where('is_available', session('search_is_available'));
        }
        // 拠点IDと荷主IDで並び替え
        return $customers->orderBy('base_id', 'asc')->orderBy('customer_sort_order', 'asc');
    }
}