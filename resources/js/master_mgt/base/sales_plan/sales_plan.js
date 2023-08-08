// 更新ボタンが押下されたら
$('#sales_plan_update_enter').on("click",function(){
    // 処理を実行するか確認
    const result = window.confirm("売上計画を更新しますか？");
    // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
    if(result == true) {
        $("#sales_plan_update_form").submit();
    }
});