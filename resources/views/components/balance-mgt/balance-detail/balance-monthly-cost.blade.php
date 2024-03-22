<div class="flex flex-col">
    <p class="mb-2">月額経費</p>
    <div class="flex flex-row text-sm mb-2">
        <p class="w-40 py-1 pl-2 bg-theme-main text-white">本社管理費</p>
        <p class="w-28 py-1 pr-2 bg-white text-right"><i class="las la-yen-sign"></i>{{ number_format($balanceMonthlyCost->ho_cost) }}</p>
    </div>
    <div class="flex flex-row text-sm mb-2">
        <p class="w-40 py-1 pl-2 bg-theme-main text-white">月額経費</p>
        <p class="w-28 py-1 pr-2 bg-white text-right"><i class="las la-yen-sign"></i>{{ number_format($balanceMonthlyCost->monthly_cost) }}</p>
    </div>
    @php
        // 各月額経費を合計
        $total_monthly_cost = $balanceMonthlyCost->ho_cost + $balanceMonthlyCost->monthly_cost;
    @endphp
    <div class="flex flex-row text-sm mb-2">
        <p class="w-40 py-1 pl-2 bg-theme-main text-white">合計</p>
        <p class="w-28 py-1 pr-2 bg-white text-right"><i class="las la-yen-sign"></i>{{ number_format($total_monthly_cost) }}</p>
    </div>
</div>