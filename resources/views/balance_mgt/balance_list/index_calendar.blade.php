@vite(['resources/js/balance_mgt/balance_list/balance_list.js'])

<x-app-layout>
    <x-page-header content="収支一覧(カレンダー)"/>
    <p class="text-xl text-center mb-1">{{ CarbonImmutable::parse(session('search_month'))->format('Y年m月') }}</p>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-balance-mgt.balance-list.calendar.search 
            :bases="$bases"
            :customers="$customers"
            :sortFieldConditions="$sort_field_conditions"
            :sortDirectionConditions="$sort_direction_conditions"
            :dispNumConditions="$disp_num_conditions"
            searchRoute="balance_list.index_calendar"
            resetRoute="balance_list.index_calendar" 
        />
        <!-- カレンダー表示 -->
        <x-balance-mgt.balance-list.calendar.list :calendarInfo="$calendar_info" />
    </div>
</x-app-layout>