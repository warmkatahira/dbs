<?php

namespace App\Services\SystemMgt\BaseMgt;

// モデル
use App\Models\Base;
use App\Models\KintaiBase;

class BaseSyncService
{
    // DB:kintaiのbasesテーブルと同期
    public function syncBase()
    {
        // DB:kintaiのbasesテーブルを全て取得
        $kintai_bases = KintaiBase::getAll()->get();
        // 追加用の配列を初期化
        $param = [];
        // レコードの分だけループ
        foreach($kintai_bases as $base){
            // 追加する内容を配列にセット
            $param[] = [
                'base_id' => $base->base_id,
                'base_name' => $base->base_name,
            ];
        }
        // テーブルへ追加(upsertなので、存在しないレコードは追加され、存在するレコードは更新される)
        Base::upsert($param, 'base_id');
        return;
    }
}