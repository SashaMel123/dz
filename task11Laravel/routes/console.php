<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Реєструємо команду Artisan 'inspire'
Artisan::command('inspire', function () {
    // Виводимо надихаючу цитату за допомогою методу comment
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly(); // Вказуємо призначення команди і задаємо, щоб вона виконувалась щогодини

