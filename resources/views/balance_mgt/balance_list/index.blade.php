<x-app-layout>
    <x-page-header content="収支一覧"/>
    <table class="text-sm block whitespace-nowrap">
        <thead>
            <tr class="text-left text-white bg-gray-600 sticky top-0">
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
            @foreach($month_info as $info)
                <tr class="text-left hover:bg-theme-sub cursor-default">
                    <td class="py-1 px-2 border">{{ \Carbon\CarbonImmutable::parse($info)->isoFormat('DD日') }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>