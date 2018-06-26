<?php

namespace framework\models;

use framework\util\DBUtils;

class Book
{
    private $db;

    public function __construct(\mysqli $db)
    {
        $this->db = $db;
    }

    public function getBooks()
    {
        $result = $this->db->query("select * from book");
        return DBUtils::getAssocArray($result);
    }

    public function getBook($b_id)
    {
        $result = $this->db->query("select * from book where b_id = " . $b_id );
        return $result->fetch_assoc();
    }

    public function addBook($isbn, $title, $author, $year, $publisher)
    {
        if ($author)
            $sql = "insert into book (isbn, title, author, `year`, publisher) values ('". $isbn ."','". $title ."','". $author ."','". $year ."','". $publisher ."')";
        else
            $sql = "insert into book (isbn, title, `year`, publisher) values ('". $isbn ."','". $title ."','". $year ."','". $publisher ."')";
        $result = $this->db->query($sql);
        return $result;
    }

    public function updateBook($b_id, $isbn, $title, $author, $year, $publisher)
    {
        if ($author)
            $sql = "update book set isbn = '". $isbn ."', title = '". $title ."', author = '". $author."', `year` = '". $year  ."', publisher = '". $publisher ."' where b_id = " . $b_id;
        else
            $sql = "update book set isbn = '". $isbn ."', title = '". $title ."', `year` = '". $year ."', publisher = '". $publisher ."' where b_id = " . $b_id;
        $result = $this->db->query($sql);
        return $result;
    }

    public function deleteBook($b_id)
    {
        $sql = "delete from book where b_id = " . $b_id;
        $result = $this->db->query($sql);
        return $result;
    }

    public function getBorrowedBooks()
    {
        $result = $this->db->query("select * from ((borrow_book AS bb INNER JOIN  book AS b ON b.b_id = bb.b_id) INNER JOIN student AS s ON bb.s_id = s.s_id)");
        return DBUtils::getAssocArray($result);
    }

    public function getBorrowedBooksBy($s_id)
    {
        $result = $this->db->query("select * from borrow_book AS bb INNER JOIN  book AS b ON b.b_id = bb.b_id WHERE bb.s_id = $s_id");
        return DBUtils::getAssocArray($result);
    }

    public function getBorrowedStudents($b_id)
    {
        $result = $this->db->query("select * from borrow_book AS bb INNER JOIN student AS s ON bb.s_id = s.s_id WHERE bb.b_id = $b_id");
        return DBUtils::getAssocArray($result);
    }

    public function borrowBook($b_id, $s_id)
    {
        $sql = "insert into borrow_book (b_id, s_id) values ('". $b_id ."','". $s_id ."')";
        $result = $this->db->query($sql);
        return $result;
    }

    public function returnBook($b_id, $s_id)
    {
        $sql = "update borrow_book set `return_date` = CURRENT_TIMESTAMP() where b_id = " . $b_id . " AND  s_id =" . $s_id;
        $result = $this->db->query($sql);
        return $result;
    }
}
