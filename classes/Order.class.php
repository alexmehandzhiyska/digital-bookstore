<?php
class Order extends Utils {

    private $_pdo = null;

    public function __construct(PDO $_pdo) {
        $this->_pdo = $_pdo;
    }

    private function _get_items_by_user($user_id) {
        $sql = "SELECT book_id FROM cart_books WHERE user_id = '$user_id';";
        
        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $items_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $book_ids = array();
            $book_ids_count = sizeof($items_data);

            for ($i =  0; $i < $book_ids_count; $i++) {
                array_push($book_ids, $items_data[$i]['book_id']);
            }

            $data = $book_ids;
        } catch (Exception $e) {
            $data = null;
        }

        return $data;
    }

    public function getItemsByUser($user_id) {
        return $this->_get_items_by_user($user_id);
    }

    private function _add_order($first_name, $last_name, $address, $phone, $additional_information) {
        $user_id = $_SESSION['user_id'];
        $sql = "INSERT INTO orders (user_id, first_name, last_name, address, phone, additional_information) VALUES ('$user_id', '$first_name', '$last_name', '$address', '$phone', '$additional_information');";

        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
    
            $data = $this->_pdo->lastInsertId();
        } catch (Exception $e) {
            $data = null;
        }
       
        return $data;
    }

    public function addOrder($first_name, $last_name, $address, $phone, $additional_information) {
        return $this->_add_order($first_name, $last_name, $address, $phone, $additional_information);
    }

    private function _add_order_items($order_id) {
        $user_id = $_SESSION['user_id'];

        try {
            $book_ids = $this->getItemsByUser($user_id);

            for ($i = 0; $i < sizeof($book_ids); $i++) {
                $order_items_query = "INSERT INTO order_items (book_id, order_id) VALUES ($book_ids[$i], $order_id);";
                $stmt = $this->_pdo->prepare($order_items_query);
                $stmt->execute();
                $data = $this->_pdo->lastInsertId();
            }
        } catch (Exception $e) {
            $data = null;
        }
        
        return $data;
    }

    public function addOrderItems($order_id) {
        return $this->_add_order_items($order_id);
    }
}