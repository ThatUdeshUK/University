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

            $form = new FormHandler();
            if ($action) {
                if ($action != 'validate') {
                    (new Router)->notFound();
                }
                if (isset($_POST['code']) && isset($_POST['isbn']) && isset($_POST['title']) && isset($_POST['year']) && isset($_POST['publisher'])) {
                    if (!isset($_POST['author']))
                        $author = null;
                    else
                        $author = $_POST['author'];
                    $result = $model->updateBook($_POST['code'], $_POST['isbn'], $_POST['title'], $author, $_POST['year'], $_POST['publisher']);
                    if ($result) {
                        (new Router())->redirect("library");
                    } else {
                        (new Router())->redirect("library");
                    }
                } else {
                    (new Router())->redirect("library/editBook/$id");
                }
            }

            $book = $model->getBook($id);
            $this->view->data['book'] = $book;

            $this->view->load('library/add-edit-book', $form);
        } else {
            (new Router())->redirect('library');
        }
    }

    public function addBook($action = false)
    {
        AuthHandler::checkSpecificAuth("librarian");

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $form = new FormHandler();
        if ($action) {
            if ($action != 'validate') {
                (new Router)->notFound();
            }
            if (isset($_POST['code']) && isset($_POST['isbn']) && isset($_POST['title']) && isset($_POST['year']) && isset($_POST['publisher'])) {
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
                    (new Router())->redirect("library");
                }
            } else {
                (new Router())->redirect("library/add");
            }
        }

        $this->view->load('library/add-edit-book', $form);
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

    public function borrowed()
    {
        AuthHandler::checkMultiSpecificAuth(array("librarian", "student"));

        $this->view->data['page_title'] = 'University';
        $this->view->data['description'] = 'University management system.';

        $model = $this->model->build('book', true);

        $this->view->data['can_edit'] = AuthHandler::isSpecificAuth("librarian");

        $books = $model->getBorrowedBooks();
        $this->view->data['books'] = $books;

        $this->view->load('library/borrowed');
    }

    public function borrowBook()
    {
        AuthHandler::checkSpecificAuth("librarian");

        if ($_POST['b_id'] && $_POST['s_id']) {
            $model = $this->model->build('book', true);
            $result = $model->borrowBook($_POST['b_id'], $_POST['s_id']);
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
