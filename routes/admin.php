<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubSubCategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'] , function(){

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/home', 'index')->name('admin.dashboard');
    });

    Route::controller(CategoryController::class)->prefix('admin/category')->group(function(){
        Route::get('/', 'index')->name('admin.category.index');
        Route::get('/create', 'create')->name('admin.category.create');
        Route::post('/store', 'store')->name('admin.category.store');
        Route::get('/edit/{id}', 'edit')->name('admin.category.edit');
        Route::get('/home_status/{id}/{status}', 'home_status')->name('admin.category.home_status');
        Route::get('/destroy/{id}', 'destroy')->name('admin.category.destroy');
    });

    Route::controller(SubCategoryController::class)->prefix('admin/sub-category')->group(function(){
        Route::get('/', 'index')->name('admin.sub-category.index');
        Route::get('/create', 'create')->name('admin.sub-category.create');
        Route::post('/store', 'store')->name('admin.sub-category.store');
        Route::post('/update', 'update')->name('admin.sub-category.update');
        Route::get('/edit/{id}', 'edit')->name('admin.sub-category.edit');
        Route::get('/home_status/{id}/{status}', 'home_status')->name('admin.sub-category.home_status');
        Route::get('/destroy/{id}', 'destroy')->name('admin.sub-category.destroy');
    });

    Route::controller(SubSubCategoryController::class)->prefix('admin/sub-sub-category')->group(function(){
        Route::get('/', 'index')->name('admin.sub-sub-category.index');
        Route::get('/create', 'create')->name('admin.sub-sub-category.create');
        Route::post('/store', 'store')->name('admin.sub-sub-category.store');
        Route::post('/update', 'update')->name('admin.sub-sub-category.update');
        Route::get('/edit/{id}', 'edit')->name('admin.sub-sub-category.edit');
        Route::get('/home_status/{id}/{status}', 'home_status')->name('admin.sub-sub-category.home_status');
        Route::get('/destroy/{id}', 'destroy')->name('admin.sub-sub-category.destroy');
        Route::post('/getcategory', 'getcategory')->name('admin.sub-sub-category.getcategory');
    });

    Route::controller(ProductController::class)->prefix('admin/products')->group(function(){
        Route::get('/', 'index')->name('admin.product.index');
        Route::get('/create', 'create')->name('admin.product.create');
        Route::post('/store', 'store')->name('admin.product.store');
        Route::post('/update', 'update')->name('admin.product.update');
        Route::get('/edit/{id}', 'edit')->name('admin.product.edit');
        Route::get('/home_status/{id}/{status}', 'home_status')->name('admin.product.home_status');
        Route::get('/destroy/{id}', 'destroy')->name('admin.product.destroy');
        Route::post('/getcategory', 'getcategory')->name('admin.product.getcategory');
    });

});

