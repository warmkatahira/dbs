<div class="">
    <p class="text-xl mb-5">保管</p>
    <table class="text-sm block whitespace-nowrap">
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
                <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balanceStorage->storage_sales) }}</td>
                <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balanceStorage->storage_cost) }}</td>
            </tr>
        </tbody>
    </table>
</div>