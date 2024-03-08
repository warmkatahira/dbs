@vite(['resources/js/balance_mgt/balance_list/balance_list.js'])

<x-app-layout>
    <x-page-header content="収支一覧(リスト)"/>
    <div class="flex flex-row mb-2">
        <!-- ページネーション -->
        <x-pagination :pages="$list_info" />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-balance-mgt.balance-list.list.search 
            :bases="$bases"
            :customers="$customers"
            searchRoute="balance_list.index_list"
            resetRoute="balance_list.index_list" 
        />
        <!-- リスト表示 -->
        <x-balance-mgt.balance-list.list.list :listInfo="$list_info" />
    </div>
</x-app-layout>