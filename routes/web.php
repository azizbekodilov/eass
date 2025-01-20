<?php

use App\Livewire\Telegram\AddAccount;
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

Route::view('/', 'welcome');

Route::group(['prefix' => 'telegram'], function () {
    // Route::post('addSession/{session}', [TelegramAccountsController::class, 'addSession']);
    // Route::post('login/{$session}', [TelegramAccountsController::class, 'login']);
    // Route::get('getSessionList', [TelegramAuthAccount::class, 'getSessionList']);
    // Route::get('getSelf/{sessionName}', [TelegramAuthAccount::class, 'getSelf']);
    // Route::get('qrLogin/login', [TelegramAuthAccount::class, 'qrLogin']);
    // Route::get('account/{id}', TelegramAuthAccount::class);
    Route::get('accountsadd', AddAccount::class);
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
