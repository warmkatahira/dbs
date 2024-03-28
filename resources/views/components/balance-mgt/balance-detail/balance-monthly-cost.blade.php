<div class="bg-white w-1300px px-5 pb-5 pt-2 mt-5">
    <div class="flex flex-row mb-5">
        <p class="text-xl">月額経費</p>
    </div>
    <table class="text-sm block whitespace-nowrap">
        <thead>
            <tr class="text-center">
                <th colspan="2" class="font-thin py-3 px-2 bg-rose-300">経費</th>
            </tr>
            <tr class="text-center">
                <th class="font-thin py-3 px-2 bg-rose-200">本社管理費</th>
                <th class="font-thin py-3 px-2 bg-rose-200">月額経費</th>
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