@vite(['resources/js/setting/sales_plan_setting/sales_plan_setting.js'])

<x-app-layout>
    <x-page-header content="売上計画登録"/>
    <x-page-back :url="session('back_url_1')" />
    <!-- バリデーションエラー -->
    <x-validation-error-msg />
    <div class="bg-white">
        <form method="POST" action="{{ route('sales_plan_setting_create.create') }}" id="sales_plan_setting_create_form">
            @csrf
            <x-div.label label="拠点" :value="Auth::user()->base->base_name" />
            <x-div.input type="month" label="売上計画年月" id="sales_plan_setting_ym" :db="null" required="1" tippy="0" />
            <x-div.input type="tel" label="売上計画" id="sales_plan" :db="null" required="1" tippy="0" />
        </form>
    </div>
    <button type="button" id="sales_plan_setting_create_enter" class="text-sm px-10 py-2 bg-theme-main text-white">登録</button>
</x-app-layout>