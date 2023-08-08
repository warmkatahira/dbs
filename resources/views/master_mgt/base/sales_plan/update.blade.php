@vite(['resources/js/master_mgt/base/sales_plan/sales_plan.js'])

<x-app-layout>
    <x-page-header content="売上計画更新"/>
    <div class="flex flex-row mb-2">
        <a href="{{ session('back_url_1') }}" class="px-5 py-1"><i class="las la-arrow-circle-left la-2x"></i></a>
    </div>
    <div class="bg-white">
        <form method="POST" action="{{ route('sales_plan_update.update') }}" id="sales_plan_update_form">
            @csrf
            <x-div.label label="拠点" :value="$sales_plan->dbs_base->base_name" />
            <x-div.label label="売上計画年月" :value="\Carbon\CarbonImmutable::parse($sales_plan->sales_plan_ym)->isoFormat('YYYY年MM月')" />
            <x-div.input type="text" label="売上計画" id="sales_plan" :db="$sales_plan->sales_plan" required="1" tippy="0" />
        </form>
    </div>
    <button type="button" id="sales_plan_update_enter" class="text-sm px-5 py-2 bg-theme-main text-white">更新</button>
</x-app-layout>