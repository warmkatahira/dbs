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