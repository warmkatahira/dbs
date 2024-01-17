// アップロードエラーのツールチップ
tippy('.tippy_upload_error', {
    // data-upload_error_date属性の値を取得
    content: function (upload_error_date) {
        return upload_error_date.getAttribute('data-upload_error_date');
    },
    duration: [1000, 0],
    allowHTML: true,
    placement: 'top-start',
});