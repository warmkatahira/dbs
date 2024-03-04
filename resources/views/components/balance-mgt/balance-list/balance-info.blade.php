<p class="text-xs truncate inline-block p-0.5 mb-1 w-36 {{ $profit >= 0 ? 'bg-amber-100 hover:bg-amber-300' : 'bg-red-300 hover:bg-red-400' }} hover:cursor-pointer transition-transform transform hover:scale-105 tippy_balance_info_disp" data-customer_name="{{ $customerName }}" data-sales="{{ $sales }}" data-cost="{{ $cost }}" data-profit="{{ $profit }}">
    {{ $customerName }}<br>
    <span class="block text-right pr-2"><i class="las la-yen-sign"></i>
        @if(session('search_sort_field') == SortFieldConditionsEnum::SALES)
            {{ number_format($sales) }}
        @elseif(session('search_sort_field') == SortFieldConditionsEnum::COST)
            {{ number_format($cost) }}
        @elseif(session('search_sort_field') == SortFieldConditionsEnum::PROFIT)
            {{ number_format($profit) }}
        @endif
    </span>
</p><br>