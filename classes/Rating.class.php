<?php
class Rating extends Utils {

    private $_pdo = null;

    public function __construct(PDO $_pdo) {
        $this->_pdo = $_pdo;
    }

    private function _get_average($book_id) {
        $sql = "SELECT rating FROM ratings WHERE book_id = $book_id";
        
        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $ratings = array();
            $ratings_count = sizeof($data);
                
            if ($ratings_count) {
                for ($i = 0; $i < $ratings_count; $i++) {
                    array_push($ratings, $data[$i]['rating']);
                }

                $averageRating = array_sum($ratings) / count($ratings);
                return floor($averageRating);
            } else {
                return 0;
            }
        } catch (Exception $error) {
            return 'error';
        }
    }

    public function getAverage($book_id) {
        return $this->_get_average($book_id);
    }

    private function _get_user_rating($book_id) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT rating FROM ratings WHERE user_id = '$user_id' AND book_id = '$book_id'";

        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['rating'];
        }

        return null;
    }

    public function getUserRating($user_id) {
        return $this->_get_user_rating($user_id);
    }

    private function _add_rating($book_id, $rating) {
        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO ratings (user_id, book_id, rating) VALUES ('$user_id', '$book_id', '$rating');";

        $stmt = $this->_pdo->prepare($sql);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } 

        return false;
    }

    public function addRating($book_id, $rating) {
        return $this->_add_rating($book_id, $rating);
    }
}