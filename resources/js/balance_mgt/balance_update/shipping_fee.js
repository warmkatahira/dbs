// 運賃追加ボタンが押下されたら
$(document).on('click', '#customer_shipping_method_create', function() {
    // 選択している情報を取得
    const customer_shipping_method_option = $('#customer_shipping_method_id').find(':selected');
    const shipping_method_id = customer_shipping_method_option.data('shipping-method-id');
    const shipping_method_name = customer_shipping_method_option.html();
    const shipping_fee_unit_price_sales = customer_shipping_method_option.data('shipping-fee-unit-price-sales');
    const shipping_fee_unit_price_cost = customer_shipping_method_option.data('shipping-fee-unit-price-cost');
    const shipping_fee_note = customer_shipping_method_option.data('shipping-fee-note');
    // 要素を追加
    $("#customer_shipping_method_tbody").append(
        `
            <tr>
                <td class="py-1 px-2 border text-left">
                    <button type="button" class="text-xs mx-3 px-3 py-1 border border-red-600 bg-red-100 customer_shipping_method_delete">削除</button>
                </td>
                <td class="py-1 px-2 border text-left">${shipping_method_name}</td>
                <td class="py-1 px-2 border"><input type="tel" name="shipping_fee_quantity_sales[]" class="text-xs text-right py-1 w-20 shipping_fee_calc" value="1" autocomplete="off"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_unit_price_sales[]" class="text-xs text-right py-1 w-20 shipping_fee_calc" value="${shipping_fee_unit_price_sales}" autocomplete="off"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_amount_sales[]" class="text-xs text-right py-1 w-24" value="${shipping_fee_unit_price_sales}" autocomplete="off"></td>
                <td class="py-1 px-2 border"><input type="tel" name="shipping_fee_quantity_cost[]" class="text-xs text-right py-1 w-20 shipping_fee_calc" value="1" autocomplete="off"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_unit_price_cost[]" class="text-xs text-right py-1 w-20 shipping_fee_calc" value="${shipping_fee_unit_price_cost}" autocomplete="off"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_amount_cost[]" class="text-xs text-right py-1 w-20" value="${shipping_fee_unit_price_cost}" autocomplete="off"></td>
                <td class="py-1 px-2 border"><input type="tel" name="shipping_fee_note[]" class="text-xs text-left py-1 w-48" value="${shipping_fee_note}" autocomplete="off"></td>
                <input type="hidden" name="shipping_method_id[]" value="${shipping_method_id}">
            </tr>
        `
    );
});

// 運賃削除ボタンが押下されたら
$(document).on('click', '.customer_shipping_method_delete', function() {
    // 一番近いtrタグを取得
    const parentTR = $(this).closest('tr');
    // 要素を削除
    parentTR.remove();
});

// 個口数か運賃単価が更新されたら
$(document).on('change', '.shipping_fee_calc', function() {
    // 一番近いtrタグを取得
    const parentTR = $(this).closest('tr');
    // trタグの中から個口数と運賃単価の値を取得、運賃金額は要素を取得
    let shipping_fee_quantity_sales = parentTR.find('[name="shipping_fee_quantity_sales[]"]').val();
    let shipping_fee_unit_price_sales = parentTR.find('[name="shipping_fee_unit_price_sales[]"]').val();
    const shipping_fee_amount_sales = parentTR.find('[name="shipping_fee_amount_sales[]"]');
    let shipping_fee_quantity_cost = parentTR.find('[name="shipping_fee_quantity_cost[]"]').val();
    let shipping_fee_unit_price_cost = parentTR.find('[name="shipping_fee_unit_price_cost[]"]').val();
    const shipping_fee_amount_cost = parentTR.find('[name="shipping_fee_amount_cost[]"]');
    // 個口数と運賃単価が問題なかったら、運賃金額を更新
    if(!isNaN(shipping_fee_quantity_sales) && !isNaN(shipping_fee_unit_price_sales)){
        if(numericCheck(Number(shipping_fee_quantity_sales)) && numericCheck(Number(shipping_fee_unit_price_sales))){
            shipping_fee_amount_sales.val(shipping_fee_quantity_sales * shipping_fee_unit_price_sales);
        }
    }
    if(!isNaN(shipping_fee_quantity_cost) && !isNaN(shipping_fee_unit_price_cost)){
        if(numericCheck(Number(shipping_fee_quantity_cost)) && numericCheck(Number(shipping_fee_unit_price_cost))){
            shipping_fee_amount_cost.val(shipping_fee_quantity_cost * shipping_fee_unit_price_cost);
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