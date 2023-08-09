// 登録ボタンが押下されたら
$('#monthly_cost_create_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("月額経費を登録しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#monthly_cost_create_form").submit();
    }
});

// 更新ボタンが押下されたら
$('#monthly_cost_update_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("月額経費を更新しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#monthly_cost_update_form").submit();
    }
});

// 削除ボタンが押下されたら
$('.monthly_cost_delete_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("月額経費を削除しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $('[name="monthly_cost_id"]').val($(this).attr('id'));
        $("#monthly_cost_delete_form_" + $(this).attr('id')).submit();
    }
});