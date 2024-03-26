<div class="flex flex-col">
    <p class="mb-2">人件費</p>
    <div class="flex flex-row text-sm mb-2">
        <p class="w-40 py-1 pl-2 bg-gray-600 text-white">正社員</p>
        <p class="w-28 py-1 pr-2 bg-white text-right"><i class="las la-yen-sign"></i>{{ number_format($balanceLaborCost->fulltime_labor_cost) }}</p>
    </div>
    <div class="flex flex-row text-sm mb-2">
        <p class="w-40 py-1 pl-2 bg-gray-600 text-white">契約社員</p>
        <p class="w-28 py-1 pr-2 bg-white text-right"><i class="las la-yen-sign"></i>{{ number_format($balanceLaborCost->contract_labor_cost) }}</p>
    </div>
    <div class="flex flex-row text-sm mb-2">
        <p class="w-40 py-1 pl-2 bg-gray-600 text-white">パート</p>
        <p class="w-28 py-1 pr-2 bg-white text-right"><i class="las la-yen-sign"></i>{{ number_format($balanceLaborCost->parttime_labor_cost) }}</p>
    </div>
    @php
        // 各人件費を合計
        $total_labor_cost = $balanceLaborCost->fulltime_labor_cost + $balanceLaborCost->contract_labor_cost + $balanceLaborCost->parttime_labor_cost;
    @endphp
    <div class="flex flex-row text-sm mb-2">
        <p class="w-40 py-1 pl-2 bg-gray-600 text-white">合計</p>
        <p class="w-28 py-1 pr-2 bg-white text-right"><i class="las la-yen-sign"></i>{{ number_format($total_labor_cost) }}</p>
    </div>
</div>