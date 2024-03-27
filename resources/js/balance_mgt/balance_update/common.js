// バリデーションを実施し、問題なければ更新
$(document).on('click', '#balance_update_enter', function() {
    // 処理を実行するか確認
    const result = window.confirm("収支更新を実行しますか？");
    // 「キャンセル」が押下されたら処理キャンセル
    if(result == false) {
        return false;
    }
    const ajax_url = '/balance_update/validation';
    const form = $('#balance_update_form');
    const formData = form.serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: ajax_url,
        data: formData,
        type: 'POST',
        dataType: 'json',
        success: function(data){
            // バリデーションエラーがある場合
            if(data['validation_errors'] != ''){
                // クラスを削除
                $('#validation_error_div').removeClass('hidden');
                // 子要素を全て削除
                $("#validation_error_div").empty();
                // 要素を追加
                $("#validation_error_div").append(`<p>${data['validation_errors']}</p>`);
                // ページトップへスクロール
                $('html, body').animate({ scrollTop: 0 }, 'slow');
                // 処理を中断（フォーム送信をさせない）
                return false;
            }
            // フォームを送信
            form.submit();
        },
        error: function(){
            alert('失敗');
        }
    });
});

// 数値入力の要素が変更されたら
$(document).on('change', '.numeric-input', function() {
    // 変更された要素の値を取得
    let value = $(this).val();
    // 以下の条件の場合はエラーを返す
    // 数値以外
    if(isNaN(value)){
        alert('数値を入力してください。\n\n' + value);
        return;
    }
    // 数値に変換
    value = Number(value);
    // 以下の条件の場合はエラーを返す
    // 整数ではない or 0より小さい
    if(!Number.isInteger(value) || value < 0){
        alert('0以上の整数を入力して下さい。\n\n' + value);
    }
});