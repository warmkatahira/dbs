<div class="">
    <p class="text-xl mb-5">月額経費</p>
    <table class="text-sm block whitespace-nowrap">
        <thead>
            <tr class="text-center">
                <th colspan="2" class="font-thin py-3 px-2 bg-balance-cost-2">経費</th>
            </tr>
            <tr class="text-center">
                <th class="font-thin py-3 px-2 bg-balance-cost-1">本社管理費</th>
                <th class="font-thin py-3 px-2 bg-balance-cost-1">月額経費</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            <tr>
                <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balanceMonthlyCost->ho_cost) }}</td>
                <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balanceMonthlyCost->monthly_cost) }}</td>
            </tr>
        </tbody>
    </table>
</div>