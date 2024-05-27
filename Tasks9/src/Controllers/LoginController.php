<?php

namespace Iplague\Project\Controllers;

use Iplague\Project\Viewer;
use JetBrains\PhpStorm\NoReturn;

class LoginController
{
    public function index(): void
    {
        $page = 'Login';
        $title = 'Login Page';

        $view = new Viewer(
            [
                'page' => $page,
                'title' => $title,
            ]
        );

        $view->render();
    }

    public function login(): void
    {
        $login = $_POST['login'];

        if ($login === 'test') {
            $_SESSION['user_id'] = 1;
            header('Location: /contact');
        } else {
            header('Location: /login');
        }
        exit;
    }

}
