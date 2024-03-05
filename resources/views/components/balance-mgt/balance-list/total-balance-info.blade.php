<div class="p-0.5 text-xs bg-black {{ $info < 0 && $label == '利益' ? 'text-red-300' : 'text-white' }}">
    <span>{{ $label }}</span>
    <span class="float-right pr-2">
        @if($isAmount)
            <i class="las la-yen-sign"></i>
        @endif
        {{ number_format($info) }}
    </span>
</div>