<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Створення таблиці 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Первинний ключ
            $table->string('name'); // Ім'я користувача
            $table->string('email')->unique(); // Унікальний email
            $table->timestamp('email_verified_at')->nullable(); // Час підтвердження email
            $table->string('password'); // Пароль
            $table->rememberToken(); // Токен для запам'ятовування
            $table->timestamps(); // Час створення та оновлення
        });

        // Створення таблиці 'password_reset_tokens'
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Первинний ключ - email
            $table->string('token'); // Токен для скидання паролю
            $table->timestamp('created_at')->nullable(); // Час створення токена
        });

        // Створення таблиці 'sessions'
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Первинний ключ - id сесії
            $table->foreignId('user_id')->nullable()->index(); // Ідентифікатор користувача (може бути null)
            $table->string('ip_address', 45)->nullable(); // IP-адреса користувача
            $table->text('user_agent')->nullable(); // Інформація про користувача (user agent)
            $table->longText('payload'); // Дані сесії
            $table->integer('last_activity')->index(); // Час останньої активності
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Видалення таблиці 'users'
        Schema::dropIfExists('users');
        // Видалення таблиці 'password_reset_tokens'
        Schema::dropIfExists('password_reset_tokens');
        // Видалення таблиці 'sessions'
        Schema::dropIfExists('sessions');
    }
};
