// 追加ボタンが押下されたら
$('#handling_fee_setting_create_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("荷役設定を追加しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $('#handling_fee_setting_create_form').submit();
    }
});

// 削除ボタンが押下されたら
$('.handling_fee_setting_delete_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("荷役設定を削除しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $('#customer_handling_id').val($(this).data('customer_handling_id'));
        $('#handling_fee_setting_delete_form').submit();
    }
});

// 追加ボタンが押下されたら
$('#handling_fee_setting_update_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("荷役設定を更新しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $('#handling_fee_setting_update_form').submit();
    }
});