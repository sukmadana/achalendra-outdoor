<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\FrontendProductController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Admin\AttributeController as AdminAttributeController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);

    /**
     * Admin Route
     *
     * Using for route on admin pages
     */

    //  Attribute
    // Route::get('admin/attribute', [AdminAttributeController::class, 'index']);
    // Route::get('admin/attribute/{slug}', [AdminAttributeController::class, 'show']);
    // Route::get('admin/attribute/delete/{slug}', [AdminAttributeController::class, 'destroy']);
    // Route::post('admin/attribute/create', [AdminAttributeController::class, 'store']);
    // Route::patch('admin/attribute/update/{slug}', [AdminAttributeController::class, 'update']);

    Route::get('admin/product-category', [AdminCategoryController::class, 'index']);
    Route::get('admin/product-category/delete/{id}', [AdminCategoryController::class, 'destroy']);
    Route::post('admin/product-category/create', [AdminCategoryController::class, 'store']);
    Route::patch('admin/product-category/update/{slug}', [AdminCategoryController::class, 'update']);

    Route::get('admin/product', [AdminProductController::class, 'index']);
    Route::get('admin/product/delete/{id}', [AdminProductController::class, 'destroy']);
    Route::get('admin/product/get/{slug}', [AdminProductController::class, 'show']);
    Route::post('admin/product/create', [AdminProductController::class, 'store']);
    Route::patch('admin/product/update/{slug}', [AdminProductController::class, 'update']);

});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');

    // Frontend
    Route::get('data-product', [FrontendProductController::class, 'getProduct']);
    Route::get('data-all-product', [FrontendProductController::class, 'getAllProduct']);
    Route::get('data-product-category', [FrontendProductController::class, 'getProductCategory']);
    Route::get('single-product/{slug}', [FrontendProductController::class, 'getProductBySlug']);
});
