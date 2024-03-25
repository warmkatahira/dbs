<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// +-+-+-+-+-+-+-+- マスタ管理 +-+-+-+-+-+-+-+-
    // 荷主マスタ
    use App\Http\Controllers\MasterMgt\Customer\CustomerController;
    // 荷主マスタ=>運賃設定
    use App\Http\Controllers\MasterMgt\ShippingFeeSetting\ShippingFeeSettingController;
    use App\Http\Controllers\MasterMgt\ShippingFeeSetting\ShippingFeeSettingCreateController;
    use App\Http\Controllers\MasterMgt\ShippingFeeSetting\ShippingFeeSettingDeleteController;
    use App\Http\Controllers\MasterMgt\ShippingFeeSetting\ShippingFeeSettingUpdateController;
    // 荷主マスタ=>荷役設定
    use App\Http\Controllers\MasterMgt\HandlingFeeSetting\HandlingFeeSettingController;
    use App\Http\Controllers\MasterMgt\HandlingFeeSetting\HandlingFeeSettingCreateController;
    use App\Http\Controllers\MasterMgt\HandlingFeeSetting\HandlingFeeSettingDeleteController;
    use App\Http\Controllers\MasterMgt\HandlingFeeSetting\HandlingFeeSettingUpdateController;

// ログインとステータスチェック
Route::middleware(['auth'])->group(function () {
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ マスタ管理 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        // -+-+-+-+-+-+-+-+-+-+-+-+ 荷主マスタ -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(CustomerController::class)->prefix('customer')->name('customer.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::get('sync', 'sync')->name('sync');
            Route::get('download', 'download')->name('download');
        });
        // -+-+-+-+-+-+-+-+-+-+-+-+ 荷主マスタ=>運賃設定 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(ShippingFeeSettingController::class)->prefix('shipping_fee_setting')->name('shipping_fee_setting.')->group(function(){
            Route::get('', 'index')->name('index');
        });
        Route::controller(ShippingFeeSettingCreateController::class)->prefix('shipping_fee_setting_create')->name('shipping_fee_setting_create.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('create', 'create')->name('create');
        });
        Route::controller(ShippingFeeSettingDeleteController::class)->prefix('shipping_fee_setting_delete')->name('shipping_fee_setting_delete.')->group(function(){
            Route::post('delete', 'delete')->name('delete');
        });
        Route::controller(ShippingFeeSettingUpdateController::class)->prefix('shipping_fee_setting_update')->name('shipping_fee_setting_update.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('update', 'update')->name('update');
        });
        // -+-+-+-+-+-+-+-+-+-+-+-+ 荷主マスタ=>荷役設定 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(HandlingFeeSettingController::class)->prefix('handling_fee_setting')->name('handling_fee_setting.')->group(function(){
            Route::get('', 'index')->name('index');
        });
        Route::controller(HandlingFeeSettingCreateController::class)->prefix('handling_fee_setting_create')->name('handling_fee_setting_create.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('create', 'create')->name('create');
        });
        Route::controller(HandlingFeeSettingDeleteController::class)->prefix('handling_fee_setting_delete')->name('handling_fee_setting_delete.')->group(function(){
            Route::post('delete', 'delete')->name('delete');
        });
        Route::controller(HandlingFeeSettingUpdateController::class)->prefix('handling_fee_setting_update')->name('handling_fee_setting_update.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('update', 'update')->name('update');
        });
});

require __DIR__.'/auth.php';
