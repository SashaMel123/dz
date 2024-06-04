use Illuminate\Foundation\Application; // Імпорт класу Application
use Illuminate\Foundation\Configuration\Exceptions; // Імпорт класу Exceptions
use Illuminate\Foundation\Configuration\Middleware; // Імпорт класу Middleware

// Налаштування додатка
return Application::configure(basePath: dirname(__DIR__))
->withRouting(
web: __DIR__.'/../routes/web.php', // Вказати шлях до файлу маршрутів веб-додатка
commands: __DIR__.'/../routes/console.php', // Вказати шлях до файлу маршрутів консольного додатка
health: '/up', // Вказати шлях до кінцевої точки перевірки стану
)
->withMiddleware(function (Middleware $middleware) {
// Визначення проміжного ПЗ тут, якщо потрібно
})
->withExceptions(function (Exceptions $exceptions) {
// Визначення обробки винятків тут, якщо потрібно
})->create(); // Створення та повернення налаштованого екземпляра додатка
