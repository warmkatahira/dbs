// 月を変更するボタンが押下されたら
$('.month_change').on("click", function() {
    sendData($(this).data('month'));
});

// プルダウンが変更されたら
$('.pulldown_change').on("change", function() {
    sendData($('#current_month').data('month'));
});

// フォームデータを送信する関数
function sendData(month) {
    // 送信する情報を取得
    const base = $('#search_base_id').val();
    const customer = $('#search_customer_id').val();
    // 送信されるタグに値をセット
    $('#search_month').val(month);
    $('#search_base').val(base);
    $('#search_customer').val(customer);
    // フォームを送信
    $("#balance_list_search_form").submit();
}