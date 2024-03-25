<div class="flex text-sm bg-gray-600 py-1 text-white pl-5">
    <p>配送方法</p>
    <span class="text-red-600 text-xs bg-red-100 text-center px-2 py-0.5 ml-auto mr-2">必須</span>
</div>
<div class="border px-10 py-5">
    <select name="shipping_method_id" class="text-sm w-96">
        @foreach($deliveryCompanies as $delivery_company)
            @foreach($delivery_company->shipping_methods as $shipping_method)
                <option value="{{ $shipping_method->shipping_method_id }}" @if($shipping_method->shipping_method_id == old('shipping_method_id', $db)) selected @endif>{{ $delivery_company->delivery_company_name.'/'.$shipping_method->shipping_method_name }}</option>
            @endforeach
        @endforeach
    </select>
</div>