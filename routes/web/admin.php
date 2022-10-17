<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Comment\CommentController;
use App\Http\Controllers\Admin\Permission\RoleController;
use App\Http\Controllers\Admin\Product\GalleryController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Permission\PermissionController;
use App\Http\Controllers\Admin\User\PermissionController as UserPermissionController;

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

Route::get('/', function () {
    return "Hello Admin";
})->name('admin.panel');

# User
Route::resource('user', UserController::class);

# Permission
Route::resource('permission', PermissionController::class);

# Role
Route::resource('role', RoleController::class);

# User-Permisssion
Route::get('user/{user}/permission/edit', [UserPermissionController::class, 'edit'])->name('user.permission');
Route::patch('user/{user}/permission/update', [UserPermissionController::class, 'update'])->name('user.permission.update');

# Products
Route::resource('product', ProductController::class);

# Comment
Route::resource('comment', CommentController::class);
Route::patch('comment/approved/{comment}', [CommentController::class, 'approve'])->name('comment.approved');

# Category
Route::get('category/manage', [CategoryController::class, 'manage'])->name('category.manage');
Route::resource('category', CategoryController::class)->except('show');

# Gallery
Route::resource('products.gallery', GalleryController::class)->except('show');

# Download
Route::get('download', function () {
    return view('admin.download.download');
})->name('download');

Route::get('download/{user}/file/', function ($file) {
    return Storage::download(request('path'));
})->name('download.file')->middleware('signed');
