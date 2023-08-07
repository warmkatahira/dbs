<x-app-layout>
    <x-page-header content="拠点マスタ"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-master-mgt.base.operation-div />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- 拠点一覧 -->
        <x-master-mgt.base.list :bases="$bases" />
    </div>
</x-app-layout>