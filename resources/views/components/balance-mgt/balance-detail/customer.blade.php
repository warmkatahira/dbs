<div class="">
    <div>
        <p class="text-xl mb-5">荷主</p>
        <div class="flex flex-row border-b-2 border-black w-96">
            <p class="w-3/12 py-2 pl-2">拠点</p>
            <p class="w-9/12 py-2 pl-2">{{ $customer->base->base_name }}</p>
        </div>
        <div class="flex flex-row border-b-2 border-black w-96">
            <p class="w-3/12 py-2 pl-2">荷主名</p>
            <p class="w-9/12 py-2 pl-2">{{ $customer->customer_name }}</p>
        </div>
    </div>
</div>