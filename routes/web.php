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
// +-+-+-+-+-+-+-+- マスタ管理 +-+-+-+-+-+-+-+-
    // 荷主マスタ
    use App\Http\Controllers\MasterMgt\Customer\CustomerController;
// +-+-+-+-+-+-+-+- 設定 +-+-+-+-+-+-+-+-
    // 売上計画
    use App\Http\Controllers\Setting\SalesPlanSetting\SalesPlanSettingController;
    use App\Http\Controllers\Setting\SalesPlanSetting\SalesPlanSettingCreateController;
    use App\Http\Controllers\Setting\SalesPlanSetting\SalesPlanSettingUpdateController;
    use App\Http\Controllers\Setting\SalesPlanSetting\SalesPlanSettingDeleteController;
    // 月額経費
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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
            Route::get('', 'index')->name('index');
        });
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ マスタ管理 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        // -+-+-+-+-+-+-+-+-+-+-+-+ 荷主マスタ -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(CustomerController::class)->prefix('customer')->name('customer.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::get('sync', 'sync')->name('sync');
            Route::get('download', 'download')->name('download');
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
