<?php
    if (isset($_POST['book_id'])) {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

        $book_id = $_POST['book_id'];
        $email = $_POST['email'];

        $data = $db->query("SELECT id, first_name FROM users WHERE email = '$email'");
        $user = $data->fetch_assoc();
        $user_id = $user['id'];
        

        $result = $db->query("DELETE FROM  wishlists  WHERE user_id = '$user_id' AND book_id = '$book_id'");

        if ($result === true) {
            echo "success";
        } else {
            echo "Error: <br>" . $db->error;
        }
    }
?>