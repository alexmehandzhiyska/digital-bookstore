<?php
require('Utils.class.php');

class User extends Utils {

    private $_pdo = null;

    public function __construct(PDO $_pdo) {
        $this->_pdo = $_pdo;
    }

    private function _check_user_exists($email, $password) {
        $sql = "SELECT * FROM users WHERE `email`='$email' AND `password`='$password'";
        
        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount() != 0){
            return $row;
        }else{
            return null;
        }
    }

    public function checkUserExists($email, $password) {
        return $this->_check_user_exists($email, $password);
    }

    private function _get_user_by_id($id) {
        $sql = "SELECT * FROM users WHERE `id`='$id';";

        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function getUserById($id) {
        return $this->_get_user_by_id($id);
    }

    private function _get_user_by_email($email) {
        $sql = "SELECT * FROM users WHERE `email`='$email';";

        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function getUserByEmail($email) {
        return $this->_get_user_by_email($email);
    }

    private function _register_user($first_name, $last_name, $email, $password) {
        $sql = "INSERT INTO users (`first_name`, `last_name`, `email`, `password`) VALUES ('$first_name', '$last_name', '$email', '$password');";

        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();

        $run = $this->_pdo->lastInsertId();
        
        return $run;
    }

    public function registerUser($first_name, $last_name, $email, $password) {
        $user_id = $this->_register_user($first_name, $last_name, $email, $password);
        return $user_id;
    }

    public function is_logged_in() {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            return true;
        }else{
            return false;
        }
    }

    private function _get_all_users() {

        $sql = "SELECT * FROM `users`";

        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            

        return $row;

    }

    public function getAllUsers() {
        return $this->_get_all_users();
    }
}