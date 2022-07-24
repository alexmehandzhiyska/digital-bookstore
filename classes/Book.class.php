<?php
class Book extends Utils {

    private $_pdo = null;

    public function __construct(PDO $_pdo){
        $this->_pdo = $_pdo;
    }

    private function _get_all() {
        $sql = "SELECT books.id AS book_id, title, pages, books.image AS book_image, price, first_name, last_name FROM books JOIN authors ON books.author_id = authors.id;";
        
        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $data = null;
        }
        
        return $data;
    }

    public function getAll() {
        return $this->_get_all();
    }

    private function _get_by_id($id) {
        $sql = "SELECT books.id AS book_id, authors.id AS author_id, title, description, genre, year_released, pages, ISBN, language, books.image AS book_image, price, first_name, last_name FROM books JOIN authors ON books.author_id = authors.id WHERE books.id = '$id';";

        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $data = null;
        }
        
        return $data;
    }

    public function getById($id) {
        return $this->_get_by_id($id);
    }

     private function _get_by_author($author_id) {
        $sql = "SELECT books.id AS book_id, authors.id AS author_id, title, books.image AS book_image FROM books JOIN authors ON books.author_id = authors.id WHERE authors.id = '$author_id';";

        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $data = null;
        }
        
        return $data;
    }

    public function getByAuthor($author_id) {
        return $this->_get_by_author($author_id);
    }
}