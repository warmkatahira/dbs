@vite(['resources/js/balance_mgt/balance_list/balance_list.js'])

<x-app-layout>
    <x-page-header content="収支一覧"/>
    <span class="text-xl pt-0.5 mr-8">{{ CarbonImmutable::parse(session('search_month'))->format('Y年m月') }}</span>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-balance-mgt.balance-list.search :bases="$bases" :customers="$customers" searchRoute="balance_list.index" resetRoute="balance_list.index" />
        <!-- カレンダー表示 -->
        <x-balance-mgt.balance-list.list :monthDate="$month_date" />
    </div>
</x-app-layout>