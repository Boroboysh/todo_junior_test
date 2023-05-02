<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Counter;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\UserAuth;
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

// RedirectIfAuthenticated - если пользователь аутентифицирован, то перенаправлять его на страницу с задачами
Route::middleware(RedirectIfAuthenticated::class)->controller(PageController::class)->group(function () {
    Route::get('/', 'getMainPage')->name('main');
    Route::get('/login', 'getLoginPage')->name('login');
    Route::get('/register', 'getRegisterPage')->name('register');
});

// UserAuth - middleware для проверки аутентификации пользователя
Route::middleware(UserAuth::class)->group(function () {
    Route::resource('todo', TaskController::class);
    Route::get('todo/{id}/delete', [TaskController::class, 'destroy'])->name('todo.destroy');
});

Route::prefix('auth')->controller(UserController::class)->group(function () {
    // Выход из учётной записи
    Route::get('/logout', 'logout')->name('logout');
    // Регистрация и аутентификация пользователя при вводе данных в форму
    Route::post('/sign-in', 'authenticate')->name('auth.sign-in');
    Route::post('/register', 'register')->name('auth.register');
});
