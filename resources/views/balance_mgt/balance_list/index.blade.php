@vite(['resources/js/balance_mgt/balance_list/balance_list.js'])

<x-app-layout>
    <x-page-header content="収支一覧"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-balance-mgt.balance-list.operation-div :bases="$bases" :customers="$customers" />
    </div>
    <div class="flex flex-row items-start">
        <table class="text-sm block whitespace-nowrap">
            <thead>
                <tr class="bg-gray-600 text-white text-left sticky top-0">
                    <th class="font-thin py-3 px-2 text-center">月</th>
                    <th class="font-thin py-3 px-2 text-center">火</th>
                    <th class="font-thin py-3 px-2 text-center">水</th>
                    <th class="font-thin py-3 px-2 text-center">木</th>
                    <th class="font-thin py-3 px-2 text-center">金</th>
                    <th class="font-thin py-3 px-2 text-center">土</th>
                    <th class="font-thin py-3 px-2 text-center">日</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($month_date as $week_date)
                    <tr class="text-left cursor-default">
                        @foreach($week_date as $date)
                            @php
                                // 週の番号を取得 
                                $day_of_week = CarbonImmutable::parse($date)->dayOfWeek;
                                // 土曜日か日曜日であれば、背景色を設定
                                $bg = '';
                                if($day_of_week == CarbonImmutable::SATURDAY){
                                    $bg = 'bg-blue-200';
                                }
                                if($day_of_week == CarbonImmutable::SUNDAY){
                                    $bg = 'bg-pink-200';
                                }
                            @endphp
                            <td class="py-1 px-2 border pb-20 pr-32 {{ $bg }}">{{ CarbonImmutable::parse($date)->isoFormat('MM/DD') }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>