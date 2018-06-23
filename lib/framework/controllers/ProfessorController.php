<?php

namespace framework\controllers;

use framework\AuthHandler;
use framework\FormHandler,
    framework\ModelFactory,
    framework\Router,
    framework\View;

class ProfessorController
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

        $model = $this->model->build('professor', true);
        $professors = $model->getProfessors();

        $professors = array_map(function($el) {
            $departmentModel = $this->model->build('department', true);
            if (isset($el['d_code'])) {
                $name = $departmentModel->getDepartment($el['d_code'])['d_name'];
                $el['department'] = $name;
            }
            return $el;
        }, $professors);

        $this->view->data['professors'] = $professors;
        $this->view->load('professor');
    }

    public function edit($id = false, $action = false)
    {
        AuthHandler::checkSpecificAuth("director");

        if ($id) {
            $this->view->data['page_title'] = 'University';
            $this->view->data['description'] = 'University management system.';

            $model = $this->model->build('professor', true);

            $form = new FormHandler();
            if ($action) {
                if ($action != 'validate') {
                    (new Router)->notFound();
                }
                if (isset($_POST['code']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['office']) && isset($_POST['d_code'])) {
                    $result = $model->updateProfessor($_POST['code'], $_POST['name'], $_POST['phone'], $_POST['office'], $_POST['d_code']);
                    if ($result) {
                        (new Router())->redirect("professor");
                    } else {
                        (new Router())->redirect("professor");
                    }
                } else {
                    (new Router())->redirect("professor/edit/$id");
                }
            }

            $professor = $model->getProfessor($id);
            $this->view->data['professor'] = $professor;

            $departmentModel = $this->model->build('department', true);
            $this->view->data['departments'] = $departmentModel->getDepartments();

            $this->view->load('add-edit-professor', $form);
        } else {
            (new Router())->redirect('professor');
        }
    }

    public function add($action = false)
    {
        AuthHandler::checkSpecificAuth("director");

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $form = new FormHandler();
        if ($action) {
            if ($action != 'validate') {
                (new Router)->notFound();
            }
            if (isset($_POST['code']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['office']) && isset($_POST['d_code'])) {
                $model = $this->model->build('professor', true);
                $result = $model->addProfessor($_POST['name'], $_POST['phone'], $_POST['office'], $_POST['d_code']);
                if ($result) {
                    (new Router())->redirect("professor");
                } else {
                    (new Router())->redirect("professor");
                }
            } else {
                (new Router())->redirect("professor/add");
            }
        }

        $departmentModel = $this->model->build('department', true);
        $this->view->data['departments'] = $departmentModel->getDepartments();

        $this->view->load('add-edit-professor', $form);
    }

    public function delete($id = false)
    {
        AuthHandler::checkSpecificAuth("director");

        if ($id) {
            $model = $this->model->build('professor', true);
            $result = $model->deleteProfessor($id);

            (new Router())->redirect('professor');
        } else {
            (new Router())->redirect('professor');
        }
    }
}
