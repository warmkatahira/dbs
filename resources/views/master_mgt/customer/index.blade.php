<x-app-layout>
    <x-page-header content="荷主マスタ"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-master-mgt.customer.operation-div />
        <!-- ページネーション -->
        <x-pagenation :pages="$customers" />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 検索条件 -->
        <x-master-mgt.customer.search :bases="$bases" searchRoute="customer.index" resetRoute="customer.index" />
        <!-- 荷主一覧 -->
        <x-master-mgt.customer.list :customers="$customers" />
    </div>
</x-app-layout>