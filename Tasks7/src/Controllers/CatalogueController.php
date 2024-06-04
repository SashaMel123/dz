<?php

namespace Iplague\Project\Controllers;

use Iplague\Project\Viewer;

class CatalogueController
{
    public function index(): void
    {
        $page = 'catalogue';
        $title = 'Catalogue Page';
        $content = 'Hello! Its Catalogue page';
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