@vite(['resources/js/master_mgt/base/monthly_cost/monthly_cost.js'])

<x-app-layout>
    <x-page-header content="月額経費更新"/>
    <div class="flex flex-row mb-2">
        <a href="{{ session('back_url_1') }}" class="px-5 py-1"><i class="las la-arrow-circle-left la-2x"></i></a>
    </div>
    <div class="bg-white">
        <form method="POST" action="{{ route('monthly_cost_update.update') }}" id="monthly_cost_update_form">
            @csrf
            <x-div.label label="拠点" :value="Auth::user()->dbs_base->base_name" />
            <x-div.label label="月額経費年月" :value="\Carbon\CarbonImmutable::parse($monthly_cost->monthly_cost_ym)->isoFormat('YYYY年MM月')" />
            <x-div.label label="経費項目" :value="$monthly_cost->dbs_item->item_name" />
            <x-div.input type="text" label="月額経費" id="monthly_cost" :db="$monthly_cost->monthly_cost" required="1" tippy="0" />
        </form>
    </div>
    <button type="button" id="monthly_cost_update_enter" class="text-sm px-10 py-2 bg-theme-main text-white">更新</button>
</x-app-layout>