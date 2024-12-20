<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicDocsMonController;
use App\Http\Controllers\DocUpmController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentFilController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', [App\Http\Controllers\PublicDocsMonController::class, 'index'])->name('index');
Route::get('/', [PublicDocsMonController::class, 'index'])->name('public.index');
Route::get('/document/filter/{slug}', [PublicDocsMonController::class, 'showFilter'])->name('public.showFilter');


Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);
Route::resource('permissions', PermissionController::class);

Route::resource('status', StatusController::class);
Route::resource('category', CategoryController::class);
// Route::get('/home', function () {
//     return view('layouts.admin.dashboard.index');
// });
Route::get('/home', [DashboardController::class, 'dashboard']);

//route slug
Route::get('/categori/checkSlug', [CategoryController::class, 'checkSlug']);


// Router DocsMon
Route::resource('docsMon', DocUpmController::class);
Route::get('/docsMon/edit/{id}', [DocUpmController::class, 'edit']);
Route::post('/docsMon/update/{id}', [DocUpmController::class, 'update'])->name(('docsMon.update'));
Route::put('/docsMon/{id}/updateStatus', [DocUpmController::class, 'updateStatus'])->name('docsMon.updateStatus');


//route filter category
Route::get('/doscsMon/{slug}', [DocumentFilController::class, 'index'])->name('doc-filter');
