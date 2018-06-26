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

        $model = $this->model->build('department', true);
        $departments = $model->getDepartments();

        $departments = array_map(function($el) {
            $professorModel = $this->model->build('professor', true);
            if (isset($el['head'])) {
                $name = $professorModel->getProfessor($el['head'])['p_name'];
                $el['head_name'] = $name;
            }
            return $el;
        }, $departments);

        $this->view->data['departments'] = $departments;
        $this->view->load('department/department');
    }

    public function edit($id = false, $action = false)
    {
        AuthHandler::checkSpecificAuth("director");

        if ($id) {
            $this->view->data['page_title'] = 'University';
            $this->view->data['description'] = 'University management system.';

            $model = $this->model->build('department', true);

            if ($action == "error") {
                $this->view->data['error'] = "Invalid Inputs.";
            } else if ($action) {
                if ($action != 'validate') {
                    (new Router)->notFound();
                }
                if (!empty($_POST['code']) && !empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['location']) && !empty($_POST['head'])) {
                    if ($_POST['head'] == -1)
                        $head = null;
                    else
                        $head = $_POST['head'];
                    $result = $model->updateDepartment($_POST['code'], $_POST['name'], $_POST['phone'], $_POST['location'], $head);
                    if ($result) {
                        (new Router())->redirect("department");
                    } else {
                        (new Router())->redirect("department/edit/$id/error");
                    }
                } else {
                    (new Router())->redirect("department/edit/$id/error");
                }
            }

            $department = $model->getDepartment($id);
            $this->view->data['department'] = $department;

            $professorModel = $this->model->build('professor', true);
            $this->view->data['professors'] = $professorModel->getProfessors();

            $this->view->load('department/add-edit-department');
        } else {
            (new Router())->redirect('department');
        }
    }

    public function add($action = false)
    {
        AuthHandler::checkSpecificAuth("director");

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        if ($action == "error") {
            $this->view->data['error'] = "Invalid Inputs.";
        } else if ($action) {
            if ($action != 'validate') {
                (new Router)->notFound();
            }
            if (!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['location'])) {
                if (isset($_POST['head']))
                    $head = null;
                else
                    $head = $_POST['head'];
                $model = $this->model->build('department', true);
                $result = $model->addDepartment($_POST['name'], $_POST['phone'], $_POST['location'], $head);
                if ($result) {
                    (new Router())->redirect("department");
                } else {
                    (new Router())->redirect("department/add/error");
                }
            } else {
                (new Router())->redirect("department/add/error");
            }
        }

        $professorModel = $this->model->build('professor', true);
        $this->view->data['professors'] = $professorModel->getProfessors();

        $this->view->load('department/add-edit-department');
    }

    public function delete($id = false)
    {
        AuthHandler::checkSpecificAuth("director");

        if ($id) {
            $model = $this->model->build('department', true);
            $result = $model->deleteDepartment($id);

            (new Router())->redirect('department');
        } else {
            (new Router())->redirect('department');
        }
    }
}
