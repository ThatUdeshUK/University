<?php

namespace framework\controllers;

use framework\AuthHandler;
use framework\FormHandler,
    framework\ModelFactory,
    framework\Router,
    framework\View;

class DepartmentController
{
    private $model;
    private $view;

    function __construct(ModelFactory $model, View $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function index()
    {
        AuthHandler::checkSpecificAuth("director");
        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';
//        $this->view->data['keywords'] = '';
        $this->view->load('department');
    }
}
