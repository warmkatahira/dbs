@vite(['resources/js/dropdown.js', 'resources/scss/dropdown.scss'])

{{-- <div class="flex flex-row">
    <a href="{{ route('customer.sync') }}" class="start_loading text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-sync mr-1"></i>荷主同期</a>
    <a href="{{ route('customer.download') }}" class="text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-download mr-1"></i>ダウンロード</a>
    <a href="{{ route('customer.upload') }}" class="text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-upload mr-1"></i>アップロード</a>
</div> --}}

<div class="flex">
    <div id="dropdown" class="dropdown">
        <button id="dropdown_btn" class="dropdown_btn"><i class="las la-stream mr-1 la-lg"></i>操作</button>
        <div class="dropdown-content" id="dropdown-content">
            <a href="{{ route('customer.sync') }}" class="start_loading text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-sync mr-1"></i>荷主同期</a>
            <a href="{{ route('customer.download') }}" class="text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-download mr-1"></i>ダウンロード</a>
            <a href="{{ route('customer.upload') }}" class="text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-upload mr-1"></i>アップロード</a>
        </div>
    </div>
</div>