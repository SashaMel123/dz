<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use Illuminate\Support\Facades\Route;

// Маршрут для головної сторінки
Route::get('/', function () {
    return view('welcome'); // Повертає представлення 'welcome'
})->name('home'); // Назва маршруту 'home'

// Маршрут для сторінки контактів
Route::get('/contact', [ContactsController::class, 'index'])->name('contact'); // Використовує метод 'index' з ContactsController, назва маршруту 'contact'

// Маршрут для сторінки про нас
Route::get('/about', [AboutController::class, 'index'])->name('about'); // Використовує метод 'index' з AboutController, назва маршруту 'about'

