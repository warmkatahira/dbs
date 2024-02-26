<table class="block whitespace-nowrap">
    <thead>
        <tr class="bg-theme-main text-white text-left sticky top-0">
            <th class="font-thin py-3 px-2 text-center">月</th>
            <th class="font-thin py-3 px-2 text-center">火</th>
            <th class="font-thin py-3 px-2 text-center">水</th>
            <th class="font-thin py-3 px-2 text-center">木</th>
            <th class="font-thin py-3 px-2 text-center">金</th>
            <th class="font-thin py-3 px-2 text-center">土</th>
            <th class="font-thin py-3 px-2 text-center">日</th>
        </tr>
    </thead>
    <tbody class="bg-white text-sm">
        @foreach($monthDate as $week_date)
            <tr class="text-left cursor-default">
                @foreach($week_date as $date)
                    <td class="py-1 px-2 border pb-20 pr-32 {{ $date['bg'] }}">{{ $date['date'] }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>