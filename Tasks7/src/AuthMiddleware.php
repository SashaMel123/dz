<?php

namespace Iplague\Project;

class AuthMiddleware
{
    public function handle($handler, $vars)
    {
        if (isset($_SESSION['user_id'])) {
            return call_user_func($handler, $vars);
        } else {
            header('Location: /'); // Перенаправити на сторінку входу
            exit;
        }
    }
}
