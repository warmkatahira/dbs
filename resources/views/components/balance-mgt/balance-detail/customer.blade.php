<div class="bg-white w-1300px px-5 pb-5 pt-2 text-sm flex flex-row">
    <div class="">
        <p class="text-xl mb-5">荷主</p>
        <div class="flex flex-row">
            <p class="bg-gray-200 w-32 py-2 pl-2">拠点</p>
            <p class="bg-theme-main text-white w-64 py-2 pl-2">{{ $customer->base->base_name }}</p>
        </div>
        <div class="flex flex-row mt-2">
            <p class="bg-gray-200 w-32 py-2 pl-2">荷主名</p>
            <p class="bg-theme-main text-white w-64 py-2 pl-2">{{ $customer->customer_name }}</p>
        </div>
    </div>
    <div class="ml-10">
        <p class="text-xl mb-5">収支</p>
        <div class="flex flex-row border-b-2 border-black w-52 bg-balance-sales-2">
            <p class="w-5/12 py-2 pl-2">売上</p>
            <p class="w-7/12 py-2 pr-2 text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balance->sales) }}</p>
        </div>
        <div class="flex flex-row border-b-2 border-black w-52 bg-balance-cost-2">
            <p class="w-5/12 py-2 pl-2">経費</p>
            <p class="w-7/12 py-2 pr-2 text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balance->cost) }}</p>
        </div>
        <div class="flex flex-row border-b-2 border-black w-52 bg-balance-profit-2">
            <p class="w-5/12 py-2 pl-2">利益</p>
            <p class="w-7/12 py-2 pr-2 text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balance->profit) }}</p>
        </div>
    </div>
</div>