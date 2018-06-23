<?php

namespace framework\controllers;

use framework\AuthHandler;
use framework\FormHandler,
    framework\ModelFactory,
    framework\Router,
    framework\View;

class IndexController
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
        AuthHandler::checkAuth();
        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';
//        $this->view->data['keywords'] = '';
        $this->view->load('home');
    }

    public function login($action = false)
    {
        AuthHandler::checkLoginAuth();
        $form = new FormHandler();
        if ($action) {
            if ($action != 'check') {
                (new Router)->notFound();
            }
            $auth = $this->model->build("auth", true);
            $user = $auth->authenticateUser($_POST['username'], $_POST['password']);
            if (isset($user)) {
                AuthHandler::login($user);
                (new Router())->redirect("");
            } else {
                (new Router())->redirect("login");
            }
        }

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';
//        $this->view->data['keywords'] = '';
        $this->view->load('login', $form);
    }

    public function logout()
    {
        AuthHandler::logout();
        (new Router())->redirect("login");
    }
}
