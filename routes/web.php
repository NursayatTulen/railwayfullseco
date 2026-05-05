<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EcoProjectController;
use App\Http\Controllers\EcoEventController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'kk', 'ru', 'he'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/eco-map', fn() => view('eco-map'))->name('eco-map');

    Route::middleware('permission:view eco-projects')->group(function () {
        Route::get('/eco-projects', [EcoProjectController::class, 'index'])->name('eco-projects.index');
    });

    Route::middleware('permission:create eco-projects')->group(function () {
        Route::get('/eco-projects/create', [EcoProjectController::class, 'create'])->name('eco-projects.create');
        Route::post('/eco-projects', [EcoProjectController::class, 'store'])->name('eco-projects.store');
    });

    Route::middleware('permission:edit eco-projects')->group(function () {
        Route::get('/eco-projects/{id}/edit', [EcoProjectController::class, 'edit'])->name('eco-projects.edit');
        Route::patch('/eco-projects/{id}', [EcoProjectController::class, 'update'])->name('eco-projects.update');
    });

    Route::middleware('permission:delete eco-projects')->group(function () {
        Route::delete('/eco-projects/{id}', [EcoProjectController::class, 'destroy'])->name('eco-projects.destroy');
    });

    Route::middleware('permission:view eco-events')->group(function () {
        Route::get('/eco-events', [EcoEventController::class, 'index'])->name('eco-events.index');
    });

    Route::middleware('permission:create eco-events')->group(function () {
        Route::get('/eco-events/create', [EcoEventController::class, 'create'])->name('eco-events.create');
        Route::post('/eco-events', [EcoEventController::class, 'store'])->name('eco-events.store');
    });

    Route::middleware('permission:edit eco-events')->group(function () {
        Route::get('/eco-events/{id}/edit', [EcoEventController::class, 'edit'])->name('eco-events.edit');
        Route::patch('/eco-events/{id}', [EcoEventController::class, 'update'])->name('eco-events.update');
    });

    Route::middleware('permission:delete eco-events')->group(function () {
        Route::delete('/eco-events/{id}', [EcoEventController::class, 'destroy'])->name('eco-events.destroy');
    });

    Route::middleware('role:admin|super-admin')->group(function () {
        Route::get('/admin/panel', [DashboardController::class, 'adminPanel'])->name('admin.panel');
    });

    Route::middleware('permission:manage users')->group(function () {
        Route::delete('/admin/users/{id}', [DashboardController::class, 'destroyUser'])->name('admin.users.destroy');
        Route::patch('/admin/users/{id}/role', [DashboardController::class, 'updateUserRole'])->name('admin.users.role');
    });

    Route::middleware('permission:view analytics')->group(function () {
        Route::get('/admin/analytics', [DashboardController::class, 'analytics'])->name('admin.analytics');
    });

    Route::middleware('role:super-admin|admin|moderator')->group(function () {
        Route::get('/upload', [UploadFileController::class, 'index'])->name('upload.index');
        Route::post('/upload', [UploadFileController::class, 'store'])->name('upload.store');
    });

    Route::get('/send-email', [MailController::class, 'sendEmail'])->name('email.send');
});

