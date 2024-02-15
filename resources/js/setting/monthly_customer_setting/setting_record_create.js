import start_loading from '../../loading';

// クリックイベント
$(document).on('click', function(e) {
    // クリックされた要素にモーダルを閉じるクラス名が設定されていれば、モーダルを閉じる
    if (e.target.classList.contains('setting_record_create_modal_close') == true) {
        // モーダルを閉じる
        $('#setting_record_create_modal').addClass('hidden');
        // 要素をクリア
        $('#select_file').val(null);
        $('#select_file_name').html(null);
    }
    // クリックした要素のIDがモーダルを開くものであれば、モーダルを開く
    if (e.target.id == 'setting_record_create_modal_open') {
        $('#setting_record_create_modal').removeClass('hidden');
    }
});

// 作成ボタンが押下されたら
$('#setting_record_create_enter').on("click",function(){
    try {
        // ファイルが選択されているか
        if ($('#create_ym').val() == '') {
            throw new Error('年月が入力されていません。');
        }
        // 処理を実行するか確認
        const result = window.confirm("設定行の追加を実行しますか？");
        // 「はい」が押下されたらsubmit、「いいえ」が押下されたら処理キャンセル
        if(result == true) {
            start_loading();
            $("#setting_record_create_form").submit();
        }
    } catch (e) {
        alert(e.message);
    }
});