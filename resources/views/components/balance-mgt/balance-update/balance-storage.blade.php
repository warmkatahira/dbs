<div class="bg-white w-1300px px-5 pb-5 pt-2 mt-5">
    <div class="flex flex-row mb-5">
        <p class="text-xl">保管</p>
    </div>
    <table class="text-xs block whitespace-nowrap">
        <thead>
            <tr class="text-center">
                <th class="font-thin py-3 px-2 bg-balance-sales-2">売上</th>
                <th class="font-thin py-3 px-2 bg-balance-cost-2">経費</th>
            </tr>
            <tr class="text-center">
                <th class="font-thin py-3 px-2 bg-balance-sales-1">保管売上</th>
                <th class="font-thin py-3 px-2 bg-balance-cost-1">保管経費</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            <tr>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="storage_sales" class="text-xs text-right py-1 w-20" value="{{ $balanceStorage->storage_sales }}" autocomplete="off"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="storage_cost" class="text-xs text-right py-1 w-20" value="{{ $balanceStorage->storage_cost }}" autocomplete="off"></td>
            </tr>
        </tbody>
    </table>
</div>