@vite(['resources/js/loading.js', 'resources/css/loading.css'])

<div id="loading" class="fixed hidden z-50 inset-0 bg-gray-400 bg-opacity-60 overflow-y-auto h-full w-full">
    <div class="wrapper top-32 mx-auto text-center">
        <div class="floating-image text-center flex flex-row">
            <img src="{{ asset('image/DBS_Logo.svg') }}" class="w-96">
        </div>
    </div>
</div>