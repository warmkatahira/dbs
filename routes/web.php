<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// +-+-+-+-+-+-+-+- Welcome +-+-+-+-+-+-+-+-
use App\Http\Controllers\Welcome\WelcomeController;
// +-+-+-+-+-+-+-+- TOP +-+-+-+-+-+-+-+-
use App\Http\Controllers\Top\TopController;
// +-+-+-+-+-+-+-+- マスタ管理 +-+-+-+-+-+-+-+-
    // 拠点マスタ
    use App\Http\Controllers\MasterMgt\Base\BaseController;
    // 売上計画
    use App\Http\Controllers\SalesPlan\SalesPlanController;
    use App\Http\Controllers\SalesPlan\SalesPlanCreateController;
    use App\Http\Controllers\SalesPlan\SalesPlanUpdateController;
    use App\Http\Controllers\SalesPlan\SalesPlanDeleteController;
    // 月額経費
    use App\Http\Controllers\MonthlyCost\MonthlyCostController;
    use App\Http\Controllers\MonthlyCost\MonthlyCostCreateController;
    use App\Http\Controllers\MonthlyCost\MonthlyCostUpdateController;
    use App\Http\Controllers\MonthlyCost\MonthlyCostDeleteController;
    // 荷主マスタ
    use App\Http\Controllers\MasterMgt\Customer\CustomerController;

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
    // ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆ マスタ管理 ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
        // -+-+-+-+-+-+-+-+-+-+-+-+ 拠点マスタ -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(BaseController::class)->prefix('base')->name('base.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::get('sync', 'sync')->name('sync');
        });
        // -+-+-+-+-+-+-+-+-+-+-+-+ 売上計画 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(SalesPlanController::class)->prefix('sales_plan')->name('sales_plan.')->group(function(){
            Route::get('', 'index')->name('index');
        });
        Route::controller(SalesPlanCreateController::class)->prefix('sales_plan_create')->name('sales_plan_create.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('create', 'create')->name('create');
        });
        Route::controller(SalesPlanUpdateController::class)->prefix('sales_plan_update')->name('sales_plan_update.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('update', 'update')->name('update');
        });
        Route::controller(SalesPlanDeleteController::class)->prefix('sales_plan_delete')->name('sales_plan_delete.')->group(function(){
            Route::post('delete', 'delete')->name('delete');
        });
        // -+-+-+-+-+-+-+-+-+-+-+-+ 月額経費 -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(MonthlyCostController::class)->prefix('monthly_cost')->name('monthly_cost.')->group(function(){
            Route::get('', 'index')->name('index');
        });
        Route::controller(MonthlyCostCreateController::class)->prefix('monthly_cost_create')->name('monthly_cost_create.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('create', 'create')->name('create');
        });
        Route::controller(MonthlyCostUpdateController::class)->prefix('monthly_cost_update')->name('monthly_cost_update.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::post('update', 'update')->name('update');
        });
        Route::controller(MonthlyCostDeleteController::class)->prefix('monthly_cost_delete')->name('monthly_cost_delete.')->group(function(){
            Route::post('delete', 'delete')->name('delete');
        });
        // -+-+-+-+-+-+-+-+-+-+-+-+ 荷主マスタ -+-+-+-+-+-+-+-+-+-+-+-+
        Route::controller(CustomerController::class)->prefix('customer')->name('customer.')->group(function(){
            Route::get('', 'index')->name('index');
            Route::get('sync', 'sync')->name('sync');
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
