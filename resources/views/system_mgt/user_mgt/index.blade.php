<x-app-layout>
    <x-page-header content="ユーザー管理"/>
    <div class="flex flex-row mb-2">
        <!-- 操作ボタン -->
        <x-system-mgt.user-mgt.operation-div />
    </div>
    <div class="flex flex-row items-start mb-2">
        <!-- ユーザー一覧 -->
        <x-system-mgt.user-mgt.list :users="$users" />
    </div>
</x-app-layout>