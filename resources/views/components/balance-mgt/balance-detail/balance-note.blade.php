<div class="">
    <div class="flex flex-row mb-5">
        <p class="text-xl">収支備考</p>
    </div>
    <p class="text-sm w-96 border border-black p-3">{!! nl2br(e(is_null($balance->note) ? 'なし' : $balance->note)) !!}</p>
</div>