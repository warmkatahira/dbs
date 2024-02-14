<div class="flex">
    <div id="dropdown" class="dropdown">
        <button id="dropdown_btn" class="dropdown_btn"><i class="las la-bars la-lg mr-1"></i>メニュー</button>
        <div class="dropdown-content" id="dropdown-content">
            <a href="{{ route('customer.sync') }}" class="dropdown-content-element start_loading text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-sync mr-1"></i>荷主同期</a>
            <a href="{{ route('customer.download') }}" class="dropdown-content-element text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-download mr-1"></i>ダウンロード</a>
        </div>
    </div>
</div>