<x-app-layout>
    <x-page-header content="収支一覧"/>
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
                        <?php $day_of_week = CarbonImmutable::parse($date)->dayOfWeek; ?>
                        <td class="py-1 px-2 border pb-20 pr-32
                            @if($day_of_week == CarbonImmutable::SATURDAY)
                                bg-blue-200 
                            @elseif($day_of_week == CarbonImmutable::SUNDAY)
                                bg-pink-200 
                            @endif">
                            {{ CarbonImmutable::parse($date)->isoFormat('MM/DD') }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>