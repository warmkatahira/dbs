<div class="">
    <div class="ml-auto">
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