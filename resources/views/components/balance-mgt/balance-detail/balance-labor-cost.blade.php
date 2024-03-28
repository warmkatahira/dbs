<div class="bg-white w-1300px px-5 pb-5 pt-2 mt-5">
    <p class="text-xl mb-5">人件費</p>
    <table class="text-sm block whitespace-nowrap">
        <thead>
            <tr class="text-center">
                <th colspan="3" class="font-thin py-3 px-2 bg-balance-cost-2">経費</th>
            </tr>
            <tr class="text-center">
                <th class="font-thin py-3 px-2 bg-balance-cost-1">正社員</th>
                <th class="font-thin py-3 px-2 bg-balance-cost-1">契約社員</th>
                <th class="font-thin py-3 px-2 bg-balance-cost-1">パート</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            <tr>
                <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balanceLaborCost->fulltime_labor_cost) }}</td>
                <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balanceLaborCost->contract_labor_cost) }}</td>
                <td class="py-1 px-2 border text-right"><i class="las la-yen-sign mr-1"></i>{{ number_format($balanceLaborCost->parttime_labor_cost) }}</td>
            </tr>
        </tbody>
    </table>
</div>