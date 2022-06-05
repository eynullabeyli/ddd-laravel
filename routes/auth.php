<?php

use Illuminate\Support\Facades\Route;
use MyApp\Http\Backend\Auth\Controllers\NewPasswordController;
use MyApp\Http\Backend\Auth\Controllers\VerifyEmailController;
use MyApp\Http\Backend\Auth\Controllers\RegisteredUserController;
use MyApp\Http\Backend\Auth\Controllers\PasswordResetLinkController;
use MyApp\Http\Backend\Auth\Controllers\AuthenticatedSessionController;
use MyApp\Http\Backend\Auth\Controllers\EmailVerificationNotificationController;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.email');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest');

Route::get('/reset-password', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.update');
Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
