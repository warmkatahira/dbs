<div class="bg-white w-1300px px-5 pb-5 pt-2 mt-5">
    <div class="flex flex-row mb-5">
        <p class="text-xl">人件費</p>
    </div>
    <table class="text-xs block whitespace-nowrap">
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
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="fulltime_labor_cost" class="text-xs text-right py-1 w-20" value="{{ $balanceLaborCost->fulltime_labor_cost }}" autocomplete="off"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="contract_labor_cost" class="text-xs text-right py-1 w-20" value="{{ $balanceLaborCost->contract_labor_cost }}" autocomplete="off"></td>
                <td class="py-1 px-2 border"><i class="las la-yen-sign mr-1"></i><input type="tel" name="parttime_labor_cost" class="text-xs text-right py-1 w-20" value="{{ $balanceLaborCost->parttime_labor_cost }}" autocomplete="off"></td>
            </tr>
        </tbody>
    </table>
</div>