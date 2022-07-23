<?php
class Author extends Utils {

    private $_pdo = null;

    public function __construct(PDO $_pdo){
        $this->_pdo = $_pdo;
    }

    private function _get_by_id($id) {
        $sql = "SELECT * FROM books JOIN authors ON books.author_id = authors.id WHERE authors.id = '$id'";

        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getById($id) {
        return $this->_get_by_id($id);
    }
}