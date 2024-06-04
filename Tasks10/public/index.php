<?php

session_start(); // Запуск сесії

require __DIR__ . '/../vendor/autoload.php'; // Підключення автозавантажувача

$db = new \Iplague\Project\Database(); // Ініціалізація підключення до бази даних

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    $homeController = new Iplague\Project\Controllers\HomeController(); // Створення контролера для головної сторінки
    $aboutController = new Iplague\Project\Controllers\AboutController(); // Створення контролера для сторінки "Про нас"
    $contactsController = new Iplague\Project\Controllers\ContactsController(); // Створення контролера для сторінки "Контакти"
    $loginController = new Iplague\Project\Controllers\LoginController(); // Створення контролера для сторінки входу

    $authMiddleware = new \Iplague\Project\AuthMiddleware(); // Ініціалізація проміжного ПЗ для автентифікації

    // Додавання маршрутів
    $r->addRoute('GET', '/', [$homeController, 'index']);
    $r->addRoute('GET', '/home', [$homeController, 'index']);
    $r->addRoute('GET', '/about', [$aboutController, 'index']);
    $r->addRoute('GET', '/login', [$loginController, 'index']);
    $r->addRoute('POST', '/login', [$loginController, 'auth']);
    $r->addRoute('GET', '/contact', function ($vars) use ($authMiddleware, $contactsController) {
        return $authMiddleware->handle([$contactsController, 'index'], $vars);
    });
    $r->addRoute('POST', '/',[$homeController, 'handleForm']);
    $r->addRoute('GET', '/home/delete', [$homeController, 'handleFormDelete']);
});

// Отримання методу та URI з деякого джерела
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Видалення рядка запиту (?foo=bar) та декодування URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Не знайдено
        header('Location: /');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Метод не дозволений
        header('Location: /');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        if (is_callable($handler)) {
            call_user_func($handler, $vars);
        } else {
            // Припускаємо, що $handler це об'єкт, який містить метод handle
            $handler->handle($handler, $vars);
        }
        break;
}
