// 運賃追加ボタンが押下されたら
$('#customer_shipping_method_create').on("click",function(){
    // 選択している情報を取得
    const customer_shipping_method_id = $('#customer_shipping_method_id').val();
    const customer_shipping_method_value = $("#customer_shipping_method_id").html();
    const customer_shipping_method_option = $('#customer_shipping_method_id').find(':selected');
    const shipping_method_id = customer_shipping_method_option.data('shipping-method-id');
    const shipping_method_name = customer_shipping_method_option.html();
    const shipping_fee_unit_price_sales = customer_shipping_method_option.data('shipping-fee-unit-price-sales');
    const shipping_fee_unit_price_cost = customer_shipping_method_option.data('shipping-fee-unit-price-cost');
    const shipping_fee_note = customer_shipping_method_option.data('shipping-fee-note');

    // 要素を追加
    $("#customer_shipping_method_tbody").append(
        `
            <tr class="">
                <td class="py-1 px-2 border text-left">
                    <button type="button" id="" class="text-xs mx-3 px-3 py-1 border border-red-600 bg-red-100">削除</button>
                </td>
                <td class="py-1 px-2 border text-left">${shipping_method_name}</td>
                <td class="py-1 px-2 border"><input type="tel" name="shipping_fee_quantity_sales[]" class="text-xs text-right py-1 w-20" value="1"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_unit_price_sales[]" class="text-xs text-right py-1 w-20" value="${shipping_fee_unit_price_sales}"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_amount_sales[]" class="text-xs text-right py-1 w-24" value="${shipping_fee_unit_price_sales}"></td>
                <td class="py-1 px-2 border"><input type="tel" name="shipping_fee_quantity_cost[]" class="text-xs text-right py-1 w-20" value="1"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_unit_price_cost[]" class="text-xs text-right py-1 w-20" value="${shipping_fee_unit_price_cost}"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="shipping_fee_amount_cost[]" class="text-xs text-right py-1 w-20" value="${shipping_fee_unit_price_cost}"></td>
                <td class="py-1 px-2 border"><input type="tel" name="shipping_fee_note[]" class="text-xs text-left py-1 w-48" value="${shipping_fee_note}"></td>
                <input type="hidden" name="shipping_method_id[]" value="${shipping_method_id}">
            </tr>
        `
    );
});

$('.shipping_fee_calc').on('change', function() {
    //alert($(this).data('category'));

    console.log($(this).parent().prev().find('input').val());
    console.log($(this).parent().next().find('input').val());

});