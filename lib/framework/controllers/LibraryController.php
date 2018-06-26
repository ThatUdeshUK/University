<?php

namespace framework\controllers;

use framework\AuthHandler;
use framework\FormHandler,
    framework\ModelFactory,
    framework\Router,
    framework\View;

class LibraryController
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
        AuthHandler::checkMultiSpecificAuth(array("librarian", "student"));

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $this->view->data['can_edit'] = AuthHandler::isSpecificAuth("librarian");

        $model = $this->model->build('book', true);
        $books = $model->getBooks();

        $this->view->data['books'] = $books;
        $this->view->load('library/book');
    }

    public function editBook($id = false, $action = false)
    {
        AuthHandler::checkSpecificAuth("librarian");

        if ($id) {
            $this->view->data['page_title'] = 'University';
            $this->view->data['description'] = 'University management system.';

            $model = $this->model->build('book', true);

            if ($action == "error") {
                $this->view->data['error'] = "Invalid Inputs.";
            } else if ($action) {
                if ($action != 'validate') {
                    (new Router)->notFound();
                }
                if (!empty($_POST['code']) && !empty($_POST['isbn']) && !empty($_POST['title']) && !empty($_POST['year']) && !empty($_POST['publisher'])) {
                    if (!isset($_POST['author']))
                        $author = null;
                    else
                        $author = $_POST['author'];
                    $result = $model->updateBook($_POST['code'], $_POST['isbn'], $_POST['title'], $author, $_POST['year'], $_POST['publisher']);
                    if ($result) {
                        (new Router())->redirect("library");
                    } else {
                        (new Router())->redirect("library/editBook/$id/error");
                    }
                } else {
                    (new Router())->redirect("library/editBook/$id/error");
                }
            }

            $book = $model->getBook($id);
            $this->view->data['book'] = $book;

            $this->view->load('library/add-edit-book');
        } else {
            (new Router())->redirect('library');
        }
    }

    public function addBook($action = false)
    {
        AuthHandler::checkSpecificAuth("librarian");

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        if ($action == "error") {
            $this->view->data['error'] = "Invalid Inputs.";
        } else if ($action) {
            if ($action != 'validate') {
                (new Router)->notFound();
            }
            if (!empty($_POST['isbn']) && !empty($_POST['title']) && !empty($_POST['year']) && !empty($_POST['publisher'])) {
                $model = $this->model->build('book', true);
                if (!isset($_POST['author']))
                    $author = null;
                else
                    $author = $_POST['author'];
                $result = $model->addBook($_POST['isbn'], $_POST['title'], $author, $_POST['year'], $_POST['publisher']);
                if ($result) {
//                    echo "Suc";
                    (new Router())->redirect("library");
                } else {
//                    echo "fail";
                    (new Router())->redirect("library/addBook/error");
                }
            } else {
                (new Router())->redirect("library/addBook/error");
            }
        }

        $this->view->load('library/add-edit-book');
    }

    public function deleteBook($id = false)
    {
        AuthHandler::checkSpecificAuth("librarian");

        if ($id) {
            $model = $this->model->build('book', true);
            $result = $model->deleteBook($id);

            (new Router())->redirect('library');
        } else {
            (new Router())->redirect('library');
        }
    }

    public function borrowed($what = false)
    {
        AuthHandler::checkSpecificAuth("librarian");

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $model = $this->model->build('book', true);

        if ($what) {
            if ($what == 'by' && !empty($_GET['s_id'])) {
                $books = $model->getBorrowedBooksBy($_GET['s_id']);
                $this->view->data['books'] = $books;
                $this->view->data['what'] = $what;
                $this->view->data['id'] = $_GET['s_id'];
            } else if ($what == 'book' && !empty($_GET['b_id'])) {
                $students = $model->getBorrowedStudents($_GET['b_id']);
                $this->view->data['students'] = $students;
                $this->view->data['what'] = $what;
                $this->view->data['id'] = $_GET['b_id'];
            }
        }

        $this->view->load('library/borrowed');
    }

    public function borrowedBooks()
    {
        AuthHandler::checkSpecificAuth("student");

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $model = $this->model->build('book', true);

        $id = AuthHandler::getCurrentID();
        if ($id) {
            $books = $model->getBorrowedBooksBy($id);
            $this->view->data['books'] = $books;
        }

        $this->view->load('library/borrowedBooks');
    }

    public function borrowBook()
    {
        AuthHandler::checkSpecificAuth("librarian");

        if ($_POST['b_id'] && $_POST['s_id']) {
            $model = $this->model->build('book', true);
            $result = $model->borrowBook($_POST['b_id'], $_POST['s_id']);
            if ($result) {
//                echo "Suc";
                (new Router())->redirect("library/borrowed");
            } else {
//                echo "fail";
                (new Router())->redirect("library/borrowed");
            }
        } else (new Router())->redirect("library/borrowed");
    }

    public function returnBook($b_id = false, $s_id = false)
    {
        AuthHandler::checkSpecificAuth("librarian");

        if ($b_id && $s_id) {
            $model = $this->model->build('book', true);
            $result = $model->returnBook($b_id, $s_id);
            if ($result) {
//                    echo "Suc";
                (new Router())->redirect("library/borrowed");
            } else {
//                    echo "fail";
                (new Router())->redirect("library/borrowed");
            }
        } else (new Router())->redirect("library/borrowed");
    }
}
