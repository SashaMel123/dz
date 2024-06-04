session_start(); // Розпочати сесію
$_SESSION['user_id'] = 1; // Встановити ідентифікатор користувача у сесії

require __DIR__ . '/../vendor/autoload.php'; // Включення автозавантажувача

// Ініціалізація підключення до бази даних
$db = new \Iplague\Project\Database();

// Створення маршрутизатора FastRoute
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

// Ініціалізація контролерів
$homeController = new Iplague\Project\Controllers\HomeController();
$aboutController = new Iplague\Project\Controllers\AboutController();
$contactsController = new Iplague\Project\Controllers\ContactsController();
$catalogueController = new Iplague\Project\Controllers\CatalogueController();

// Ініціалізація проміжного ПЗ (middleware)
$authMiddleware = new \Iplague\Project\AuthMiddleware();

// Визначення маршрутів
$r->addRoute('GET', '/', [$homeController, 'index']);
$r->addRoute('GET', '/home', [$homeController, 'index']);
$r->addRoute('GET', '/about', [$aboutController, 'index']);
$r->addRoute('GET', '/catalogue', [$catalogueController, 'index']);

// Захищений маршрут за допомогою проміжного ПЗ (middleware)
$r->addRoute('GET', '/contacts', function ($vars) use ($authMiddleware, $contactsController) {
return $authMiddleware->handle([$contactsController, 'index'], $vars);
});

// Обробка відправлення форми
$r->addRoute('POST', '/', [$homeController, 'handleForm']);

// Обробка запиту на видалення
$r->addRoute('GET', '/home/delete', [$homeController, 'handleFormDelete']);
});

// Отримання методу та URI з сервера
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Відокремлення рядка запиту (?foo=bar) та декодування URI
if (false !== $pos = strpos($uri, '?')) {
$uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

// Диспетчеризація маршруту
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
case FastRoute\Dispatcher::NOT_FOUND:
// Обробка 404 Not Found
header('Location: /');
break;
case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
// Обробка 405 Method Not Allowed
$allowedMethods = $routeInfo[1];
header('Location: /');
break;
case FastRoute\Dispatcher::FOUND:
$handler = $routeInfo[1];
$vars = $routeInfo[2];
if (is_callable($handler)) {
// Якщо обробник є викликана функція, викликаємо її змінними
call_user_func($handler, $vars);
} else {
// Припускаючи, що $handler - це об'єкт, який містить метод handle
$handler->handle($handler, $vars);
}
break;
}
