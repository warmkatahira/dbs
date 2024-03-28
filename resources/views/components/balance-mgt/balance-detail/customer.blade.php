<div class="bg-white px-5 pb-5 pt-2 text-sm">
    <p class="text-xl mb-5">荷主</p>
    <div class="flex flex-row">
        <p class="bg-gray-300 w-32 py-2 pl-2">拠点</p>
        <p class="bg-theme-main text-white w-64 py-2 pl-2">{{ $customer->base->base_name }}</p>
    </div>
    <div class="flex flex-row mt-2">
        <p class="bg-gray-300 w-32 py-2 pl-2">荷主名</p>
        <p class="bg-theme-main text-white w-64 py-2 pl-2">{{ $customer->customer_name }}</p>
    </div>
</div>