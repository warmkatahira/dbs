<div class="flex">
    <div id="dropdown" class="dropdown">
        <button id="dropdown_btn" class="dropdown_btn"><i class="las la-bars la-lg mr-1"></i>メニュー</button>
        <div class="dropdown-content" id="dropdown-content">
            <a href="{{ route('customer.sync') }}" class="dropdown-content-element start_loading text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-sync mr-1"></i>荷主同期</a>
            <a href="{{ route('customer.download') }}" class="dropdown-content-element text-sm bg-theme-main text-white py-2 px-10 mr-10 ml-auto"><i class="las la-download mr-1"></i>ダウンロード</a>
            <div class="flex">
                <form method="POST" action="{{ route('customer.upload') }}" id="upload_form" enctype="multipart/form-data" class="m-0 mr-10">
                    @csrf
                    <div class="flex select_file">
                        <label class="dropdown-content-element text-sm hover:cursor-pointer">
                            <i class="las la-upload mr-1"></i>アップロード
                            <input type="file" id="select_file" name="csvFile" class="hidden">
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="flex">
        @if(session('customer_upload_error'))
            <x-upload-error downloadRoute="customer.upload_error_download" :uploadErrorDate="session('customer_upload_error')[0]['アップロード日時']"/>
        @endif
    </div>
</div>