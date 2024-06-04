<?php

namespace Iplague\Project\Controllers;

use Iplague\Project\Viewer;

class ContactsController
{
    public function index(): void
    {
        $page = 'contact';
        $title = 'Contact Page';
        $content = 'Hello! Its Contact page';
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
}
