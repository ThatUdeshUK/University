<?php

namespace framework\controllers;

use framework\AuthHandler;
use framework\FormHandler,
    framework\ModelFactory,
    framework\Router,
    framework\View;

class StudentController
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
        AuthHandler::checkMultiSpecificAuth(array("registrar", "student"));
        (new Router())->redirect('student/undergraduate');
    }

    public function undergraduate()
    {
        AuthHandler::checkMultiSpecificAuth(array("registrar", "student"));

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $this->view->data['type'] = "undergraduate";
        $this->view->data['can_edit'] = AuthHandler::isSpecificAuth("registrar");

        $model = $this->model->build('student', true);
        $students = $model->getUGStudents();

        $this->view->data['students'] = $students;
        $this->view->load('student/student');
    }

    public function graduate()
    {
        AuthHandler::checkMultiSpecificAuth(array("registrar", "student"));

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $this->view->data['type'] = "graduate";
        $this->view->data['can_edit'] = AuthHandler::isSpecificAuth("registrar");

        $model = $this->model->build('student', true);
        $students = $model->getGStudents();

        $this->view->data['students'] = $students;
        $this->view->load('student/student');
    }

    public function nonMatriculating()
    {
        AuthHandler::checkMultiSpecificAuth(array("registrar", "student"));

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $this->view->data['type'] = "nonMatriculating";
        $this->view->data['can_edit'] = AuthHandler::isSpecificAuth("registrar");

        $model = $this->model->build('student', true);
        $students = $model->getNMStudents();

        $this->view->data['students'] = $students;
        $this->view->load('student/student');
    }


    public function edit($type = false, $id = false, $action = false)
    {
        AuthHandler::checkSpecificAuth("registrar");

        if ($id) {
            $this->view->data['page_title'] = 'University';
            $this->view->data['description'] = 'University management system.';

            if (!$type || !($type == "undergraduate" || $type == "graduate" || $type == "nonMatriculating"))
                (new Router())->redirect("student");

            $model = $this->model->build('student', true);

            $form = new FormHandler();
            if ($action) {
                if ($action != 'validate') {
                    (new Router)->notFound();
                }
                if (isset($_POST['s_id']) && isset($_POST['name']) && isset($_POST['address']) && isset($_POST['status'])) {
                    if ($type == "undergraduate") {
                        $result = $model->updateUGStudent($_POST['s_id'], $_POST['name'], $_POST['address'], $_POST['status']);
                    } else if ($type == "graduate" && isset($_POST['ug_major'])) {
                        $result = $model->updateGStudent($_POST['s_id'], $_POST['name'], $_POST['address'], $_POST['status'], $_POST['ug_major']);
                    } else if ($type == "nonMatriculating" && isset($_POST['study_hours'])) {
                        $result = $model->updateNMStudent($_POST['s_id'], $_POST['name'], $_POST['address'], $_POST['status'], $_POST['study_hours']);
                    } else {
                        $result = null;
                    }
                    if ($result) {
//                    echo "Suc";
                        (new Router())->redirect("student/$type");
                    } else {
//                    echo "fail";
                        (new Router())->redirect("student/$type");
                    }
                } else {
                    (new Router())->redirect("student/edit/$type/$id");
                }
            }

            if ($type == "undergraduate") {
                $student = $model->getUGStudent($id);
            } else if ($type == "graduate") {
                $student = $model->getGStudent($id);
            } else if ($type == "nonMatriculating") {
                $student = $model->getNMStudent($id);
            } else {
                $student = null;
            }
            $this->view->data['student'] = $student;
            $this->view->data['type'] = $type;

            $this->view->load('student/add-edit-student', $form);
        } else {
            (new Router())->redirect('student');
        }
    }

    public function add($type = false, $action = false)
    {
        AuthHandler::checkSpecificAuth("registrar");

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        if (!$type || !($type == "undergraduate" || $type == "graduate" || $type == "nonMatriculating"))
            (new Router())->redirect("student");

        $form = new FormHandler();
        if ($action) {
            if ($action != 'validate' || !$type) {
                (new Router)->notFound();
            }
            if (isset($_POST['name']) && isset($_POST['address']) && isset($_POST['status'])) {
                $model = $this->model->build('student', true);
                if ($type == "undergraduate") {
                    $result = $model->addUGStudent($_POST['name'], $_POST['address'], $_POST['status']);
                } else if ($type == "graduate" && isset($_POST['ug_major'])) {
                    $result = $model->addGStudent($_POST['name'], $_POST['address'], $_POST['status'], $_POST['ug_major']);
                } else if ($type == "nonMatriculating" && isset($_POST['study_hours'])) {
                    $result = $model->addNMStudent($_POST['name'], $_POST['address'], $_POST['status'], $_POST['study_hours']);
                } else {
                    $result = null;
                }
                if ($result) {
//                    echo "Suc";
                    (new Router())->redirect("student/$type");
                } else {
//                    echo "fail";
                    (new Router())->redirect("student/$type");
                }
            } else {
                (new Router())->redirect("student/$type");
            }
        }

        $this->view->data['type'] = $type;

        $this->view->load('student/add-edit-student', $form);
    }

    public function delete($type = false, $id = false)
    {
        AuthHandler::checkSpecificAuth("registrar");

        if ($id) {
            if (!$type || !($type == "undergraduate" || $type == "graduate" || $type == "nonMatriculating"))
                (new Router())->redirect("student");

            $model = $this->model->build('student', true);
            $result = $model->deleteStudent($id);

            (new Router())->redirect("student/$type");
        } else {
            (new Router())->redirect('student');
        }
    }
}
