<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();
Route::prefix('/admin')->middleware('auth')->group(function () {
//    Route::resources([
//        'set' => App\Http\Controllers\SetController::class,
//        'category' => App\Http\Controllers\ParentCategoryController::class,
//        'company' => App\Http\Controllers\CompanyController::class,
//    ]);
     //   ->except('show');
    Route::resource('set', App\Http\Controllers\Admin\SetController::class)
        ->except('show');
    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class)
        ->except('show');
    Route::resource('company', App\Http\Controllers\Admin\CompanyController::class)
        ->except('show');
});
Route::prefix('/public')->group(function () {
    Route::get('/{company}/{parentCategory}/{nestedCategory}/{set}', [App\Http\Controllers\SetController::class, 'index'])->name('public.set.index');;
    Route::get('/{company}/{parentCategory}/{nestedCategory}', [App\Http\Controllers\NestedCategoryController::class, 'index'])->name('public.nestedCategory.index');
    Route::get('/{company}/{parentCategory}', [App\Http\Controllers\ParentCategoryController::class, 'index'])->name('public.category.index');
    Route::get('/{company}', [App\Http\Controllers\CompanyController::class, 'index'])->name('public.company.index');
});

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('main.index');

