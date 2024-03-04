// アップロードエラーのツールチップ
tippy('.tippy_balance_info_disp', {
    // data-balance属性の値を取得
    content: function (balance) {
        // 荷主名/売上/経費を取得して返す
        const customer_name = balance.getAttribute('data-customer_name');
        const sales = balance.getAttribute('data-sales').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        const cost = balance.getAttribute('data-cost').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        const profit = balance.getAttribute('data-profit').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        return customer_name + '<br><br>' +
               '売上：<i class="las la-yen-sign"></i>' + sales + '<br>' +
               '経費：<i class="las la-yen-sign"></i>' + cost + '<br>' +
               '利益：<i class="las la-yen-sign"></i>' + profit;
    },
    duration: [1000, 0],
    allowHTML: true,
    placement: 'right-start',
});