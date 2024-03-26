<div class="flex">
    <div id="dropdown" class="dropdown">
        <button id="dropdown_btn" class="dropdown_btn"><i class="las la-bars la-lg mr-1"></i>メニュー</button>
        <div class="dropdown-content" id="dropdown-content">
            <a href="{{ route('balance_update.index', ['balance_id' => $balance->balance_id]) }}" class="dropdown-content-element text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-edit la-lg mr-1"></i>収支更新</a>
        </div>
    </div>
</div>