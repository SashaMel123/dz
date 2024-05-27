<?php

namespace Iplague\Project;

class AuthMiddleware
{
    public function handle($handler, $vars)
    {
        if ($_SESSION['login'] === 'test') {
            return call_user_func($handler, $vars);
        } else {
            header('Location: /login'); // Перенаправити на сторінку входу
            exit;
        }
    }
}
