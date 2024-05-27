<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact', [ContactsController::class, 'index'])->name('contact');
Route::get('/about', [AboutController::class, 'index'])->name('about');
