<?php

namespace Iplague\Project\Controllers;

class LoginController
{
    public function index(): void
    {
        $page = 'login';
        $title = 'Login Page';
        $content = 'Hello! Its Login page';
        $info = 'l.ngfkjdfgjkfdjkfzgbkj.zfdgbj.fzdgb.kjzg';

        $view = new Viewer(
            [
                'page' => $page,
                'title' => $title,
                'content' => $content,
                'info' => $info
            ]
        );

        $view->render();
    }

    public function login(): void
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if ($login === 'admin' && $password === '123') {
            $_SESSION['user_id'] = 1;
            header('Location: /');
            exit;
        } else {
            header('Location: /login');
            exit;
        }
    }

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        header('Location: /');
        exit;
    }

}
