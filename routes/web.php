<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SahamOwnedController;
use App\Http\Controllers\SahamSaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controller::class, 'login'])->name('login');
Route::get('/register', [Controller::class, 'register'])->name('register');
Route::post('/login-auth', [Controller::class, 'login_auth'])->name('login-auth');
Route::get('/logout', [Controller::class, 'logout'])->name('logout');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::post('/send-qna', [DashboardController::class, 'send_qna'])->name('send-qna');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard-manager', [DashboardController::class, 'index_manager'])->name('dashboard-manager');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/faq/store', [FaqController::class, 'store'])->name('faq.store');
    Route::delete('/faq/delete/{id}', [FaqController::class, 'delete'])->name('faq.delete');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/detail-sell-saham', [SahamSaleController::class, 'detail_sell_saham'])->name('detail-sell-saham');
    Route::post('/store-sell-saham-user', [SahamSaleController::class, 'store_sell_saham_user'])->name('store-sell-saham-user');

    Route::get('/form-buy-saham/{id}', [SahamSaleController::class, 'form_buy_saham'])->name('form-buy-saham');
    Route::post('/store-buy-saham/{id}', [SahamSaleController::class, 'store_buy_saham'])->name('store-buy-saham');
});

Route::middleware(['auth', 'role:company'])->group(function () {
    Route::get('/dashboard-company', [DashboardController::class, 'index_company'])->name('dashboard-company');
    Route::post('/store-edit-saham/{id}', [SahamOwnedController::class, 'store_edit_saham'])->name('store-edit-saham');
    Route::post('/store-make-saham/{id}', [SahamOwnedController::class, 'store_make_saham'])->name('store-make-saham');
    Route::post('/store-sell-saham/{id}', [SahamSaleController::class, 'store_sell_saham'])->name('store-sell-saham');
});

Route::middleware(['auth', 'role:user|admin'])->group(function () {
    Route::get('/dashboard-general', [DashboardController::class, 'index'])->name('dashboard-general');
    Route::get('/detail-saham/{id}', [DashboardController::class, 'detail_saham'])->name('detail-saham');
});
