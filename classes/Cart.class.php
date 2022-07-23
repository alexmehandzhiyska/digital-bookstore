<?php
class Cart extends Utils {

    private $_pdo = null;

    public function __construct(PDO $_pdo) {
        $this->_pdo = $_pdo;
    }

    private function _get_by_user($user_id) {
        $sql = "SELECT books.id AS book_id, title, genre, books.image AS book_image, price, first_name, last_name FROM books JOIN authors ON books.author_id = authors.id WHERE books.id IN (SELECT book_id FROM cart_books WHERE user_id = '$user_id');";
        
        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        } catch (Exception $error) {
            return 'error';
        }
    }

    public function getByUser($book_id) {
        return $this->_get_by_user($book_id);
    }

    private function _add_to_cart($book_id) {
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO cart_books (user_id, book_id) VALUES ('$user_id', '$book_id');";

        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();

        $record_id = $this->_pdo->lastInsertId();

        return $record_id;
    }

    public function addToCart($book_id) {
        return $this->_add_to_cart($book_id);
    }

    private function _reset_cart() {
        $user_id = $_SESSION['user_id'];
        $sql = "DELETE FROM cart_books WHERE user_id = $user_id;";

        $stmt = $this->_pdo->prepare($sql);
        $result = $stmt->execute();

        return $result;
    }

    public function resetCart() {
        return $this->_reset_cart();
    }
}