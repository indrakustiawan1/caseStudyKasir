<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

// Route::get('/admin', function () {
//     return view('admin.dashboard.dashboard');
// });

//tess
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::post('hitungKembalian', [LandingController::class, 'hitungKembalian'])->name('hitungKembalian');
//tes

Route::get('/admin', [AuthController::class, 'index'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth'])->group(
    function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //Role
        Route::post('role/datatables_role', [RoleController::class, 'datatables_role'])->name('role-list');
        Route::get('role', [RoleController::class, 'index'])->name('role');
        Route::post('role', [RoleController::class, 'store']);
        Route::get('role/{role}/edit', [RoleController::class, 'edit']);
        Route::delete('role/{role}', [RoleController::class, 'destroy']);

        //user
        Route::post('user/datatables_user', [UserController::class, 'datatables_user'])->name('user-list');
        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::post('user', [UserController::class, 'store']);
        Route::post('user/store_user_permission', [UserController::class, 'store_user_permission']);
        Route::get('user/{user}/edit', [UserController::class, 'edit']);
        Route::get('user/{user}/edit_user_permission', [UserController::class, 'edit_user_permission']);
        Route::delete('user/{user}', [UserController::class, 'destroy']);
        Route::post('user/{user}/resetpassword', [UserController::class, 'resetpassword']);

        //Permission
        Route::post('permission/datatables_permission', [PermissionController::class, 'datatables_permission'])->name('permission-list');
        Route::get('permission', [PermissionController::class, 'index'])->name('permission');
        Route::post('permission', [PermissionController::class, 'store']);
        Route::get('permission/{permission}/edit', [PermissionController::class, 'edit']);
        Route::delete('permission/{permission}', [PermissionController::class, 'destroy']);
    }
);
