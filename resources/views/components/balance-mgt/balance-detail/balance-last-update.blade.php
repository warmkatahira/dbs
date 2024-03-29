<div class="flex w-1300px mb-2">
    <div class="text-sm ml-auto text-right">
        <p class="mb-2">最終更新</p>
        <p><i class="las la-user la-lg mr-1"></i>{{ $balance?->user?->last_name.' '.$balance?->user?->first_name }}</p>
        <p><i class="las la-clock la-lg mr-1"></i>{{ CarbonImmutable::parse($balance->updated_at)->isoFormat('Y年MM月DD日 HH時mm分ss秒') }}</p>
    </div>
</div>