// 追加ボタンが押下されたら
$('#shipping_fee_setting_create_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("運賃設定を追加しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $('#shipping_fee_setting_create_form').submit();
    }
});

// 削除ボタンが押下されたら
$('.shipping_fee_setting_delete_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("運賃設定を削除しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $('#customer_shipping_method_id').val($(this).data('customer_shipping_method_id'));
        $('#shipping_fee_setting_delete_form').submit();
    }
});

// 追加ボタンが押下されたら
$('#shipping_fee_setting_update_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("運賃設定を更新しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $('#shipping_fee_setting_update_form').submit();
    }
});