// 収支情報表示のツールチップ
tippy('.tippy_balance_info_disp', {
    // data-balance属性の値を取得
    content: function (balance) {
        // 荷主/拠点/売上/経費を取得（数値関係は3桁でカンマ区切り）
        const customer_name = balance.getAttribute('data-customer_name');
        const base_name = balance.getAttribute('data-base_name');
        const sales = balance.getAttribute('data-sales').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        const cost = balance.getAttribute('data-cost').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        const profit = balance.getAttribute('data-profit').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        const profit_ratio = ((balance.getAttribute('data-profit') / balance.getAttribute('data-sales')) * 100).toFixed(2);
        // 利益だけマイナスであれば色を変えたいので、確認してタグを調整する
        let start_tag = '';
        let end_tag = '';
        if(parseInt(profit) < 0){
            start_tag = '<span class="text-red-500">';
            end_tag = '</span>';
        }
        // 拠点と荷主があれば情報を出力
        let base_name_info = '';
        if(base_name != ''){
            base_name_info = `
                <tr>
                    <td class="border border-black px-2 py-2 bg-theme-main text-white">拠点</td>
                    <td class="border border-black px-2 py-2">${base_name}</td>
                </tr>
            `;
        };
        // テーブルタグの先頭部分
        const table_start_tag = `
            <table class="text-xs">
                <tbody>
        `;
        // テーブルタグの末尾部分
        const table_end_tag = `
                </tbody>
            </table>
        `;
        // 金額情報をテーブル化
        const amount_info = `
            <tr>
                <td class="border border-black px-2 py-2 bg-theme-main text-white">荷主</td>
                <td class="border border-black px-2 py-2">${customer_name}</td>
            </tr>
            <tr>
                <td class="border border-black px-2 py-2 bg-theme-main text-white">売上</td>
                <td class="border border-black px-2 py-2 text-right"><i class="las la-yen-sign"></i>${sales}</td>
            </tr>
            <tr>
                <td class="border border-black px-2 py-2 bg-theme-main text-white">経費</td>
                <td class="border border-black px-2 py-2 text-right"><i class="las la-yen-sign"></i>${cost}</td>
            </tr>
            <tr>
                <td class="border border-black px-2 py-2 bg-theme-main text-white">利益</td>
                <td class="border border-black px-2 py-2 text-right">${start_tag}<i class="las la-yen-sign"></i>${profit}${end_tag}</td>
            </tr>
            <tr>
                <td class="border border-black px-2 py-2 bg-theme-main text-white">利益率</td>
                <td class="border border-black px-2 py-2 text-right">${profit_ratio}<i class="las la-percent"></i></td>
            </tr>
        `;
        return table_start_tag + base_name_info + amount_info + table_end_tag;
    },
    duration: [1000, 700],
    allowHTML: true,
    placement: 'right',
    theme: 'light-border',
});