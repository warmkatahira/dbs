<!-- 荷主情報 -->
<div class="flex flex-col text-sm mb-3">
    <div class="flex flex-row">
        <p class="bg-gray-600 text-white py-2 pl-2 w-28">拠点</p>
        <p class="bg-white py-2 pl-2 w-52">{{ $customer->dbs_base->base_name }}</p>
    </div>
    <div class="flex flex-row mt-2">
        <p class="bg-gray-600 text-white py-2 pl-2 w-28">荷主名</p>
        <p class="bg-white py-2 pl-2 w-96">{{ $customer->customer_name }}</p>
    </div>
</div>