<div class="bg-white border border-gray-600 shadow-md mr-3">
    <p class="text-sm bg-gray-600 text-white py-3 text-center">検索条件</p>
    <form method="GET" action="{{ route($searchRoute) }}" id="search_form" class="m-0">
        <div class="flex flex-col px-3 w-60">
            <x-search.date-YM id="search_month" label="年月" />
            <x-search.select-1 id="search_base_id" label="拠点" :searchConditions="$bases" value="base_id" text="base_name" />
            <x-search.select-1 id="search_customer_id" label="荷主" :searchConditions="$customers" value="customer_id" text="customer_name" />
            <x-search.select-2 id="search_sort_field" label="並び替え項目" :searchConditions="$sortFieldConditions" value="value" text="text" />
            <x-search.select-2 id="search_sort_direction" label="並び替え順序" :searchConditions="$sortDirectionConditions" value="value" text="text" />
            <x-search.select-2 id="search_disp_num" label="表示件数" :searchConditions="$dispNumConditions" value="value" text="text" />
            <button type="submit" class="text-sm text-center border border-blue-500 text-blue-500 bg-blue-100 py-2 mt-2 shadow-md">
                <i class="las la-search la-lg"></i>検索
            </button>
            <a href="{{ route($resetRoute) }}" class="text-sm text-center border border-black bg-gray-100 py-2 my-2 shadow-md">
                <i class="las la-eraser la-lg"></i>リセット
            </a>
        </div>
        <input type="hidden" name="search_enter" value="true">
    </form>
</div>