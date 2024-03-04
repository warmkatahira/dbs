<table class="block whitespace-nowrap table-fixed">
    <thead>
        <tr class="bg-theme-main text-white text-left sticky top-0">
            <th class="font-thin py-3 px-2 text-center border">月</th>
            <th class="font-thin py-3 px-2 text-center border">火</th>
            <th class="font-thin py-3 px-2 text-center border">水</th>
            <th class="font-thin py-3 px-2 text-center border">木</th>
            <th class="font-thin py-3 px-2 text-center border">金</th>
            <th class="font-thin py-3 px-2 text-center border">土</th>
            <th class="font-thin py-3 px-2 text-center border">日</th>
        </tr>
    </thead>
    <tbody class="bg-white text-sm">
        @foreach($calendarInfo as $week_date)
            <tr class="text-left cursor-default">
                @foreach($week_date as $date => $balances)
                    @php
                        // 土曜日と日曜日だったら、カレンダーの背景色を設定
                        $bg = '';
                        if(CarbonImmutable::parse($date)->dayOfWeek == CarbonImmutable::SATURDAY){
                            $bg = 'bg-blue-100';
                        }
                        if(CarbonImmutable::parse($date)->dayOfWeek == CarbonImmutable::SUNDAY){
                            $bg = 'bg-pink-100';
                        }
                    @endphp
                    <td class="py-1 px-2 border align-top w-40 h-20 {{ $bg }}">
                        <p class="pb-2">{{ CarbonImmutable::parse($date)->isoFormat('MM/DD') }}</p>
                        @foreach($balances['top_balances'] as $balance)
                            <x-balance-mgt.balance-list.balance-info :customerName="$balance['customer_name']" :sales="$balance['sales']" :cost="$balance['cost']" :profit="$balance['profit']" />
                        @endforeach
                        @if(!empty($balances['other_balances']))
                            <x-balance-mgt.balance-list.balance-info customerName="上記以外" :sales="$balances['other_balances_total_sales']" :cost="$balances['other_balances_total_cost']" :profit="$balances['other_balances_total_profit']" />
                        @endif
                        @if($balances['balance_count'] > 0)
                            <div class="p-0.5 text-xs bg-black text-white text-center">トータル</div>
                            <x-balance-mgt.balance-list.total-balance-info label="収支数" :info="$balances['balance_count']" />
                            <x-balance-mgt.balance-list.total-balance-info label="売上" :info="$balances['total_sales']" />
                            <x-balance-mgt.balance-list.total-balance-info label="経費" :info="$balances['total_cost']" />
                            <x-balance-mgt.balance-list.total-balance-info label="利益" :info="$balances['total_profit']" />
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>