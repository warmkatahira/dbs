<div class="flex flex-col">
    <p class="mb-2">{{ $label }}</p>
    <div class="flex flex-row text-sm mb-2">
        <p class="w-40 py-1 pl-2 bg-gray-600 text-white">{{ $label }}</p>
        <p class="w-28 py-1 pr-2 bg-white text-right"><i class="las la-yen-sign"></i>{{ number_format($balanceStorage->$column) }}</p>
    </div>
</div>