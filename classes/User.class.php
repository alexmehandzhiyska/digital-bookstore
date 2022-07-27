<?php
class User extends Utils {

    private $_pdo = null;

    public function __construct(PDO $_pdo) {
        $this->_pdo = $_pdo;
    }

    private function _check_user_exists($email, $password) {
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password';";
        
        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if($stmt->rowCount() != 0){
                $data = $row;
            } else{
                $data = null;
            }
        } catch (Exception $e) {
            $data = null;
        }
        
        return $data;
    }

    public function checkUserExists($email, $password) {
        return $this->_check_user_exists($email, $password);
    }

    private function _register_user($first_name, $last_name, $email, $password) {
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password');";

        try {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute();
    
            $data = $this->_pdo->lastInsertId();
        } catch (Exception $e) {
            $data = null;
        }
        
        return $data;
    }

    public function registerUser($first_name, $last_name, $email, $password) {
        return $this->_register_user($first_name, $last_name, $email, $password);
    }

    public function is_logged_in() {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            return true;
        }else{
            return false;
        }
    }
}