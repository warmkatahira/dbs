<div class="flex">
    @php
        // 今月・前月・翌月を取得
        $current_month = CarbonImmutable::now()->startOfMonth()->format('Y-m-d');
        $last_month = CarbonImmutable::parse(session('search_month'))->subMonth()->format('Y-m-d');
        $next_month = CarbonImmutable::parse(session('search_month'))->addMonth()->format('Y-m-d');
    @endphp
    <!-- 月関連の情報 -->
    <span data-month="{{ $current_month }}" id="current_month" class="month_change bg-black text-white text-sm px-5 py-2 mr-8">今月</span>
    <span data-month="{{ $last_month }}" class="month_change bg-black text-white text-sm px-5 py-3 mr-8" value="{{ $last_month }}"><i class="las la-angle-left"></i></span>
    <span class="text-2xl pt-0.5 mr-8">{{ CarbonImmutable::parse(session('search_month'))->format('Y年m月') }}</span>
    <span data-month="{{ $next_month }}" class="month_change bg-black text-white text-sm px-5 py-3 mr-8"><i class="las la-angle-right"></i></span>
    <!-- 拠点の情報 -->
    <select id="search_base_id" class="pulldown_change text-xs mr-8">
        @foreach($bases as $base)
            <option value="{{ $base->base_id }}" @if($base->base_id == session('search_base')) selected @endif>{{ $base->base_name }}</option>
        @endforeach
    </select>
    <!-- 荷主の情報 -->
    <select id="search_customer_id" class="pulldown_change text-xs">
        <option value="" @if(null == session('search_customer')) selected @endif>全て</option>
        @foreach($customers as $customer)
            <option value="{{ $customer->customer_id }}" @if($customer->customer_id == session('search_customer')) selected @endif>{{ $customer->customer_name }}</option>
        @endforeach
    </select>
    <form method="GET" action="{{ route('balance_list.index') }}" id="balance_list_search_form" class="m-0">
        <input type="hidden" id="search_month" name="search_month">
        <input type="hidden" id="search_base" name="search_base">
        <input type="hidden" id="search_customer" name="search_customer">
        <input type="hidden" name="search_enter" value="true">
    </form>
</div>