<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// +-+-+-+-+-+-+-+- Welcome +-+-+-+-+-+-+-+-
    use App\Http\Controllers\Welcome\WelcomeController;
// +-+-+-+-+-+-+-+- TOP +-+-+-+-+-+-+-+-
    use App\Http\Controllers\Top\TopController;
// +-+-+-+-+-+-+-+- 収支管理 +-+-+-+-+-+-+-+-
    // 収支一覧
    use App\Http\Controllers\BalanceMgt\BalanceListController;
    // 収支詳細
    use App\Http\Controllers\BalanceMgt\BalanceDetailController;
    // 収支更新
    use App\Http\Controllers\BalanceMgt\BalanceUpdateController;
// +-+-+-+-+-+-+-+- 設定 +-+-+-+-+-+-+-+-
    // 売上計画設定
    use App\Http\Controllers\Setting\SalesPlanSetting\SalesPlanSettingController;
    use App\Http\Controllers\Setting\SalesPlanSetting\SalesPlanSettingCreateController;
    use App\Http\Controllers\Setting\SalesPlanSetting\SalesPlanSettingUpdateController;
    use App\Http\Controllers\Setting\SalesPlanSetting\SalesPlanSettingDeleteController;
    // 月額経費設定
    use App\Http\Controllers\Setting\MonthlyCostSetting\MonthlyCostSettingController;
    use App\Http\Controllers\Setting\MonthlyCostSetting\MonthlyCostSettingCreateController;
    use App\Http\Controllers\Setting\MonthlyCostSetting\MonthlyCostSettingUpdateController;
    use App\Http\Controllers\Setting\MonthlyCostSetting\MonthlyCostSettingDeleteController;
    // 月別荷主設定
    use App\Http\Controllers\Setting\MonthlyCustomerSetting\MonthlyCustomerSettingController;
    use App\Http\Controllers\Setting\MonthlyCustomerSetting\MonthlyCustomerSettingCreateRecordController;
// +-+-+-+-+-+-+-+- システム管理 +-+-+-+-+-+-+-+-
    // 拠点管理
    use App\Http\Controllers\SystemMgt\BaseMgt\BaseMgtController;
    // ユーザー管理
    use App\Http\Controllers\SystemMgt\UserMgt\UserMgtController;
// +-+-+-+-+-+-+-+- テスト +-+-+-+-+-+-+-+-
    // テスト
    use App\Http\Controllers\TestController;



// ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ Welcome ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
    // -+-+-+-+-+-+-+-+-+-+-+-+ Welcome -+-+-+-+-+-+-+-+-+-+-+-+
    Route::controller(WelcomeController::class)->prefix('')->name('welcome.')->group(function(){
        Route::get('', 'index')->name('index');
    });

// ログインとステータスチェック
Route::middleware(['auth'])->group(function () {
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ Top ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        // -+-+-+-+-+-+-+-+-+-+-+-+ TOP -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(TopController::class)->prefix('top')->name('top.')->group(function(){
            Route::get('', 'index')->name('index');
        });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 収支管理 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        // -+-+-+-+-+-+-+-+-+-+-+-+ 収支一覧 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(BalanceListController::class)->prefix('balance_list')->name('balance_list.')->group(function(){
            Route::get('index_calendar', 'index_calendar')->name('index_calendar');
            Route::get('index_list', 'index_list')->name('index_list');
        });
        // -+-+-+-+-+-+-+-+-+-+-+-+ 収支詳細 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(BalanceDetailController::class)->prefix('balance_detail')->name('balance_detail.')->group(function(){
            Route::get('', 'index')->name('index');
        });
        // -+-+-+-+-+-+-+-+-+-+-+-+ 収支更新 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(BalanceUpdateController::class)->prefix('balance_update')->name('balance_update.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('validation', 'validation')->name('validation');
            Route::post('update', 'update')->name('update');
        });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ 設定 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        // -+-+-+-+-+-+-+-+-+-+-+-+ 売上計画設定 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(SalesPlanSettingController::class)->prefix('sales_plan_setting')->name('sales_plan_setting.')->group(function(){
            Route::get('', 'index')->name('index');
        });
        Route::controller(SalesPlanSettingCreateController::class)->prefix('sales_plan_setting_create')->name('sales_plan_setting_create.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('create', 'create')->name('create');
        });
        Route::controller(SalesPlanSettingUpdateController::class)->prefix('sales_plan_setting_update')->name('sales_plan_setting_update.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('update', 'update')->name('update');
        });
        Route::controller(SalesPlanSettingDeleteController::class)->prefix('sales_plan_setting_delete')->name('sales_plan_setting_delete.')->group(function(){
            Route::post('delete', 'delete')->name('delete');
        });
        // -+-+-+-+-+-+-+-+-+-+-+-+ 月額経費設定 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(MonthlyCostSettingController::class)->prefix('monthly_cost_setting')->name('monthly_cost_setting.')->group(function(){
            Route::get('', 'index')->name('index');
        });
        Route::controller(MonthlyCostSettingCreateController::class)->prefix('monthly_cost_setting_create')->name('monthly_cost_setting_create.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('create', 'create')->name('create');
        });
        Route::controller(MonthlyCostSettingUpdateController::class)->prefix('monthly_cost_setting_update')->name('monthly_cost_setting_update.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('update', 'update')->name('update');
        });
        Route::controller(MonthlyCostSettingDeleteController::class)->prefix('monthly_cost_setting_delete')->name('monthly_cost_setting_delete.')->group(function(){
            Route::post('delete', 'delete')->name('delete');
        });
        // -+-+-+-+-+-+-+-+-+-+-+-+ 月別荷主設定 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(MonthlyCustomerSettingController::class)->prefix('monthly_customer_setting')->name('monthly_customer_setting.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::get('download', 'download')->name('download');
            Route::post('upload', 'upload')->name('upload');
            Route::get('upload_error_download', 'upload_error_download')->name('upload_error_download');
        });
        Route::controller(MonthlyCustomerSettingCreateRecordController::class)->prefix('monthly_customer_setting_create_record')->name('monthly_customer_setting_create_record.')->group(function(){
            Route::post('create', 'create')->name('create');
        });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ システム管理 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        // -+-+-+-+-+-+-+-+-+-+-+-+ 拠点管理 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(BaseMgtController::class)->prefix('base_mgt')->name('base_mgt.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::get('sync', 'sync')->name('sync');
        });
        // -+-+-+-+-+-+-+-+-+-+-+-+ ユーザー管理 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(UserMgtController::class)->prefix('user_mgt')->name('user_mgt.')->group(function(){
            Route::get('', 'index')->name('index');
        });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ テスト ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        Route::controller(TestController::class)->prefix('test')->name('test.')->group(function(){
            Route::get('balance_create', 'balance_create')->name('balance_create');
            Route::get('labor_cost_update', 'labor_cost_update')->name('labor_cost_update');
            Route::get('monthly_customer_setting_create', 'monthly_customer_setting_create')->name('monthly_customer_setting_create');
            Route::get('sales_cost_allocation', 'sales_cost_allocation')->name('sales_cost_allocation');
        });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
