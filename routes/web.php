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
