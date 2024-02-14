// 登録ボタンが押下されたら
$('#sales_plan_setting_create_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("売上計画を登録しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#sales_plan_setting_create_form").submit();
    }
});

// 更新ボタンが押下されたら
$('#sales_plan_setting_update_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("売上計画を更新しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#sales_plan_setting_update_form").submit();
    }
});

// 削除ボタンが押下されたら
$('.sales_plan_setting_delete_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("売上計画を削除しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $('[name="sales_plan_setting_id"]').val($(this).attr('id'));
        $("#sales_plan_setting_delete_form_" + $(this).attr('id')).submit();
    }
});