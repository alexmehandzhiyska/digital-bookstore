<?php
class Wishlist extends Utils {

    private $_pdo = null;

    public function __construct(PDO $_pdo) {
        $this->_pdo = $_pdo;
    }

    private function _get_by_user($user_id) {
        $sql = "SELECT books.id AS book_id, title, books.image AS book_image, price, first_name, last_name FROM books JOIN authors ON books.author_id = authors.id WHERE books.id IN (SELECT book_id FROM wishlists WHERE user_id = '$user_id')";
        
        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $error) {
            $data = null;
        }

        return $data;
    }

    public function getByUser($user_id) {
        return $this->_get_by_user($user_id);
    }

    private function _check_if_wishlisted($book_id) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT books.id FROM books WHERE books.id IN (SELECT book_id FROM wishlists WHERE user_id = '$user_id' AND book_id = '$book_id');";

        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($data) {
                return true;
            }

            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    public function checkIfWishlisted($book_id) {
        return $this->_check_if_wishlisted($book_id);
    }

    private function _add_to_wishlist($book_id) {
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO wishlists (user_id, book_id) VALUES ('$user_id', '$book_id');";

        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
    
            $data = $this->_pdo->lastInsertId();
        } catch (Exception $e) {
            $data = null;
        }

        return $data;
    }

    public function addToWishlist($book_id) {
        return $this->_add_to_wishlist($book_id);
    }

    private function _remove_from_wishlist($book_id) {
        $user_id = $_SESSION['user_id'];
        $sql = "DELETE FROM  wishlists  WHERE user_id = '$user_id' AND book_id = '$book_id';";

        try {
            $stmt = $this->_pdo->prepare($sql);
            $data = $stmt->execute();
    
            if ($data) {
                return true;
            }
    
            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    public function removeFromWishlist($book_id) {
        return $this->_remove_from_wishlist($book_id);
    }
}