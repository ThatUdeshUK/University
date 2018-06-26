<?php

namespace framework\controllers;

use framework\AuthHandler;
use framework\FormHandler,
    framework\ModelFactory,
    framework\Router,
    framework\View;

class CourseController
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
        AuthHandler::checkMultiSpecificAuth(array("professor", "student"));
        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $model = $this->model->build('course', true);
        $courses = $model->getCourses();

        $this->view->data['can_edit'] = AuthHandler::isSpecificAuth("professor");

        $courses = array_map(function($el) {
            if (isset($el['prerequisite'])) {
                $model = $this->model->build('course', true);
                $pre_name = $model->getCourse($el['prerequisite'])['name'];
                $el['prerequisite_name'] = $pre_name;
            }
            $departmentModel = $this->model->build('department', true);
            if (isset($el['d_code'])) {
                $name = $departmentModel->getDepartment($el['d_code'])['d_name'];
                $el['department'] = $name;
            }
            return $el;
        }, $courses);

        $this->view->data['courses'] = $courses;
        $this->view->load('course/course');
    }

    public function edit($id = false, $action = false)
    {
        AuthHandler::checkSpecificAuth("professor");

        if ($id) {
            $this->view->data['page_title'] = 'University';
            $this->view->data['description'] = 'University management system.';

            $model = $this->model->build('course', true);

            if ($action == "error") {
                $this->view->data['error'] = "Invalid Inputs.";
            } else if ($action) {
                if ($action != 'validate') {
                    (new Router)->notFound();
                }
                if (!empty($_POST['code']) && !empty($_POST['name']) && !empty($_POST['credit']) && !empty($_POST['hours'])
                    && !empty($_POST['college']) && !empty($_POST['d_code'])) {
                    if ($_POST['prerequisite'] == -1)
                        $prerequisite = null;
                    else
                        $prerequisite = $_POST['prerequisite'];
                    $result = $model->updateCourse($_POST['code'], $_POST['name'], $_POST['credit'], $_POST['hours'],
                        $_POST['college'], $prerequisite, $_POST['d_code']);
                    if ($result) {
                        (new Router())->redirect("course");
                    } else {
                        (new Router())->redirect("course/edit/$id/error");
                    }
                } else {
                    (new Router())->redirect("course/edit/$id/error");
                }
            }

            $course = $model->getCourse($id);
            $this->view->data['course'] = $course;

            $departmentModel = $this->model->build('department', true);
            $this->view->data['departments'] = $departmentModel->getDepartments();
            $this->view->data['courses'] = $model->getCourses();

            $this->view->load('course/add-edit-course');
        } else {
            (new Router())->redirect("course/edit/$id/error");
        }
    }

    public function add($action = false)
    {
        AuthHandler::checkSpecificAuth("professor");

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $model = $this->model->build('course', true);

        if ($action == "error") {
            $this->view->data['error'] = "Invalid Inputs.";
        } else if ($action) {
            if ($action != 'validate') {
                (new Router)->notFound();
            }

            if (!empty($_POST['name']) && !empty($_POST['credit']) && !empty($_POST['hours']) && !empty($_POST['college'])
                && !empty($_POST['d_code'])) {
                if ($_POST['prerequisite'] == -1)
                    $prerequisite = null;
                else
                    $prerequisite = $_POST['prerequisite'];
                $result = $model->addCourse($_POST['name'], $_POST['credit'], $_POST['hours'], $_POST['college'],
                    $prerequisite, $_POST['d_code']);
                if ($result) {
                    (new Router())->redirect("course");
                } else {
                    (new Router())->redirect("course/add/error");
                }
            } else {
                (new Router())->redirect("course/add/error");
            }
        }

        $departmentModel = $this->model->build('department', true);
        $this->view->data['departments'] = $departmentModel->getDepartments();
        $this->view->data['courses'] = $model->getCourses();

        $this->view->load('course/add-edit-course');
    }

    public function delete($id = false)
    {
        AuthHandler::checkSpecificAuth("professor");

        if ($id) {
            $model = $this->model->build('course', true);
            $result = $model->deleteCourse($id);

            (new Router())->redirect('course');
        } else {
            (new Router())->redirect('course');
        }
    }
}
