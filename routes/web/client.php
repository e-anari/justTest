<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Client\Profile\ProfileController;
use App\Http\Controllers\Client\TwoFactorAuth\TwoFactorAuthController;
use App\Http\Controllers\Client\Product\ProductController as ShopController;

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
Route::get('/auth/socialite', [HomeController::class, 'socialite'])->name('socialite');
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
Route::get('/auth/change-password', [ChangePasswordController::class, 'showChangeForm'])->name('show-change-form');
Route::post('/auth/change-password', [ChangePasswordController::class, 'change'])->name('change-password');
// Route::get('/email/page-with-email-verification', [BasicController::class, 'emailVerification'])->middleware('verified')->name('email.verification');
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect()->route('email.verification');
// })->middleware(['auth', 'signed'])->name('verification.verify');

# Home
Route::get('/', [HomeController::class, 'index'])->name('home');

# Profile
Route::get('profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile/{user}/edit', [ProfileController::class, 'update'])->name('profile.update');
Route::get('profile/{user}/confirm-password', [ProfileController::class, 'confirmPassword'])->middleware('password.confirm')->name('profile.confirmPassword');
Route::get('profile/{user}/2factor-auth', [ProfileController::class, 'twoFactorAuth'])->name('profile.twoFactorAuth');
Route::get('profile/{user}/email-verify', [ProfileController::class, 'emailVerify'])->name('profile.emailVerify');
Route::get('profile/{user}/empty-email', [ProfileController::class, 'emptyEmailMsg'])->name('profile.emptyEmailMsg');
Route::get('profile/{user}/email-verified', [ProfileController::class, 'verifyEmailDone'])->middleware('verified')->name('profile.verifyEmailDone');

# Two Factor Auth
Route::post('2factor-auth/post-type', [TwoFactorAuthController::class, 'postType'])->name('post-type-2factor-auth');
Route::get('2factor-auth/get-token', [TwoFactorAuthController::class, 'getToken'])->name('get-token-2factor-auth');
Route::patch('2factor-auth/post-token', [TwoFactorAuthController::class, 'postToken'])->name('post-token-2factor-auth');

# Products
Route::get('shop', [ShopController::class, 'shop'])->name('shop');
Route::get('detail/{product}', [ShopController::class, 'detail'])->name('detail');

# Catgeories
Route::get('');

# Cart
Route::get('cart', [CartController::class,'cart'])->name('cart');
Route::get('cart/add/{product}', [CartController::class, 'addToCart'])->name('addToCart');

# APIs
// Route::get('APIsList',[APIController::class,'list'])->name('apiList');
