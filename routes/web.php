<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang/visi-misi', function () {
    return view('about.visi-misi');
})->name('about.visi-misi');

// Authentication Routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

// Google Auth Routes
Route::get('/auth/google', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback']);

// SPMB Online Routes
Route::get('/spmb', [App\Http\Controllers\SpmbController::class, 'index'])->name('spmb.index');
Route::get('/spmb/daftar', [App\Http\Controllers\SpmbController::class, 'create'])->name('spmb.create');
Route::post('/spmb/daftar', [App\Http\Controllers\SpmbController::class, 'store'])->name('spmb.store');

// Admin Dashboard Routes
Route::get('/admin/dashboard', [App\Http\Controllers\AuthController::class, 'adminDashboard'])->name('admin.dashboard');

// Kepegawaian (HR) Routes
Route::get('/kepegawaian', [App\Http\Controllers\EmployeeController::class, 'index'])->name('kepegawaian.index');

// Sistem Informasi Terpadu Routes
Route::prefix('sistem')->group(function () {
    Route::get('/ppdb', [App\Http\Controllers\SystemController::class, 'ppdb'])->name('sistem.ppdb');
    Route::get('/akademik', [App\Http\Controllers\SystemController::class, 'akademik'])->name('sistem.akademik');
    Route::get('/keuangan', [App\Http\Controllers\SystemController::class, 'keuangan'])->name('sistem.keuangan');
    Route::get('/hrd', [App\Http\Controllers\SystemController::class, 'hrd'])->name('sistem.hrd');
    Route::get('/inventaris', [App\Http\Controllers\SystemController::class, 'inventaris'])->name('sistem.inventaris');
});

// Cek SPP Publik
Route::get('/cek-spp', [App\Http\Controllers\FinanceController::class, 'publicCekSpp'])->name('public.cek-spp');

// Public Post API & Details
Route::get('/api/posts', [App\Http\Controllers\PostController::class, 'getByCategory']);
Route::get('/berita/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');

// Registration Routes
Route::get('/daftar', [App\Http\Controllers\SystemController::class, 'registration'])->name('daftar');

// Admin Management Routes
Route::prefix('admin')->group(function () {
    // Keuangan & SPP
    Route::get('/finance', [App\Http\Controllers\FinanceController::class, 'adminIndex'])->name('admin.finance.index');
    Route::get('/spp', [App\Http\Controllers\FinanceController::class, 'adminSppIndex'])->name('admin.spp.index');
    // Posts
    Route::get('/posts', [App\Http\Controllers\PostController::class, 'adminIndex'])->name('admin.posts.index');
    Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('admin.posts.store');
    Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('admin.posts.destroy');
    
    // Registrations (SPMB)
    Route::get('/registrations', [App\Http\Controllers\SpmbController::class, 'adminIndex'])->name('admin.registrations.index');
    Route::post('/registrations/{registration}/status', [App\Http\Controllers\SpmbController::class, 'updateStatus'])->name('admin.registrations.status');

    // Employees (HR)
    Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'adminIndex'])->name('admin.employees.index');
    Route::get('/employees/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('/employees', [App\Http\Controllers\EmployeeController::class, 'store'])->name('admin.employees.store');
    Route::get('/employees/{employee}/edit', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('admin.employees.edit');
    Route::put('/employees/{employee}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('admin.employees.update');
    Route::delete('/employees/{employee}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('admin.employees.destroy');

    // Inventory
    Route::get('/inventory', [App\Http\Controllers\InventoryController::class, 'adminIndex'])->name('admin.inventory.index');
    Route::get('/inventory/create', [App\Http\Controllers\InventoryController::class, 'create'])->name('admin.inventory.create');
    Route::post('/inventory', [App\Http\Controllers\InventoryController::class, 'store'])->name('admin.inventory.store');
    Route::get('/inventory/{inventory}/edit', [App\Http\Controllers\InventoryController::class, 'edit'])->name('admin.inventory.edit');
    Route::put('/inventory/{inventory}', [App\Http\Controllers\InventoryController::class, 'update'])->name('admin.inventory.update');
    Route::delete('/inventory/{inventory}', [App\Http\Controllers\InventoryController::class, 'destroy'])->name('admin.inventory.destroy');
});

// Public Inventory Route
Route::get('/inventaris', [App\Http\Controllers\InventoryController::class, 'index'])->name('inventaris.index');
