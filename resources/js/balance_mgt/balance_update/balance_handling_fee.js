// 荷役追加ボタンが押下されたら
$(document).on('click', '#customer_handling_create', function() {
    // 選択している情報を取得
    const customer_handling_option = $('#customer_handling_id').find(':selected');
    const handling_id = customer_handling_option.data('handling-id');
    const handling_name = customer_handling_option.data('handling-name');
    const handling_fee_unit_price = customer_handling_option.data('handling-fee-unit-price');
    const handling_fee_note = customer_handling_option.data('handling-fee-note');
    // 要素を追加
    $("#customer_handling_tbody").append(
        `
            <tr>
                <td class="py-1 px-2 border text-left">
                    <button type="button" class="text-xs mx-3 px-3 py-1 border border-red-600 bg-red-100 customer_handling_delete">削除</button>
                </td>
                <td class="py-1 px-2 border text-left">${handling_name}</td>
                <td class="py-1 px-2 border"><input type="tel" name="handling_fee_quantity[]" class="text-xs text-right py-1 w-20 handling_fee_calc" value="1" autocomplete="off"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="handling_fee_unit_price[]" class="text-xs text-right py-1 w-20 handling_fee_calc" value="${handling_fee_unit_price}" autocomplete="off"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="handling_fee_amount[]" class="text-xs text-right py-1 w-24" value="${handling_fee_unit_price}" autocomplete="off"></td>
                <td class="py-1 px-2 border"><input type="tel" name="handling_fee_note[]" class="text-xs text-left py-1 w-48" value="${handling_fee_note}" autocomplete="off"></td>
                <input type="hidden" name="handling_id[]" value="${handling_id}">
            </tr>
        `
    );
});

// 荷役削除ボタンが押下されたら
$(document).on('click', '.customer_handling_delete', function() {
    // 一番近いtrタグを取得
    const parentTR = $(this).closest('tr');
    // 要素を削除
    parentTR.remove();
});

// 荷役数か荷役単価が更新されたら
$(document).on('change', '.handling_fee_calc', function() {
    // 一番近いtrタグを取得
    const parentTR = $(this).closest('tr');
    // trタグの中から荷役数と荷役単価の値を取得、荷役金額は要素を取得
    let handling_fee_quantity = parentTR.find('[name="handling_fee_quantity[]"]').val();
    let handling_fee_unit_price = parentTR.find('[name="handling_fee_unit_price[]"]').val();
    const handling_fee_amount = parentTR.find('[name="handling_fee_amount[]"]');
    // 荷役数と荷役単価が問題なかったら、荷役金額を更新
    if(!isNaN(handling_fee_quantity) && !isNaN(handling_fee_unit_price)){
        if(numericCheck(Number(handling_fee_quantity)) && numericCheck(Number(handling_fee_unit_price))){
            handling_fee_amount.val(handling_fee_quantity * handling_fee_unit_price);
        }
    }
});

// 数値のチェック
function numericCheck(value){
    // 以下の条件の場合はエラーを返す
    // 整数ではない or 0より小さい
    if(!Number.isInteger(value) || value < 0){
        return false;
    }
    return true;
}