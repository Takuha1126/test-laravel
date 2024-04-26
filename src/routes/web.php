<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ThankController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\Auth\ShopAuthController;
use App\Http\Controllers\CreateShopRepresentativeController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\PaymentController;




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


Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('home');
    Route::get('/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');
    Route::get('/search', [ShopController::class, 'search'])->name('search.get');
    Route::post('/search', [ShopController::class, 'search'])->name('search.post');
    Route::get('/done', [ReservationController::class, 'completed'])->name('done');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservation.show');
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::get('/thanks', [ThankController::class, 'index'])->name('thanks');
    Route::get('/favorite/status/{shopId}', [FavoriteController::class, 'getStatus'])->name('favorite.status');
    Route::post('/favorite/toggle/{shopId}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::delete('/favorite/toggle/{shopId}', [FavoriteController::class, 'toggle']);
    Route::get('/evaluation', [EvaluationController::class, 'index'])->name('evaluation.show');
    Route::post('/reviews', [EvaluationController::class, 'store'])->name('evaluation.store');
    Route::post('/reservation/{reservationId}/visit', [EvaluationController::class, 'visit'])->name('visit');
    Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.page');
    Route::post('/create-payment-intent', [PaymentController::class, 'handlePayment'])->name('payment.handle');

});


Route::middleware(['web','auth.shop'])->group(function () {
    Route::get('/shops/reservations', [ReservationController::class, 'showReservationList'])->name('shops.reservations.list');
    Route::get('/shops/create-update/{id}', [ShopController::class, 'showCreateUpdateForm'])->name('shops.create-update');
    Route::put('/shop/{id}', [ShopController::class, 'update'])->name('shop.update');
    Route::get('/shop/verify', [ReservationController::class,'showQrVerification'])->name('shop.verify.show');
    Route::post('/shop/verify
', [ReservationController::class,'verify'])->name('shop.verify');



});

Route::middleware(['auth.admin'])->group(function () {
        Route::get('/admin', [CreateShopRepresentativeController::class, 'showForm'])->name('admin.index');
        Route::get('/admin/create', [CreateShopRepresentativeController::class, 'create'])->name('admin.create');
        Route::post('/shop_representatives', [CreateShopRepresentativeController::class, 'store'])->name('shop_representatives.store');
        Route::delete('/representatives/{representative}', [CreateShopRepresentativeController::class, 'destroy'])->name('representatives.destroy');
        Route::get('/send-notification', [CreateShopRepresentativeController::class, 'showSendForm'])->name('send-notification.form');
        Route::post('/send-notification/single', [CreateShopRepresentativeController::class, 'sendNotification'])->name('send-notification.single');
        Route::post('/send-notification/all', [CreateShopRepresentativeController::class,'sendAll'])->name('send-notification.all');
    });


Route::get('/shop/login', [ShopAuthController::class, 'showLoginForm'])->name('shop.login');
Route::post('/shop/login', [ShopAuthController::class, 'login'])->name('shop.login.submit');
Route::post('/shop/logout', [ShopAuthController::class, 'logout'])->name('shop.logout');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/register', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [AdminAuthController::class, 'register']);




