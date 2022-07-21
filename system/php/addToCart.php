<?php
    require('conf/db.conf.php');

    if (isset($_POST['book_id'])) {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

        $user_id = $_POST['user_id'];
        $book_id = $_POST['book_id'];

        $result = $db->query("INSERT INTO cart_books (user_id, book_id) VALUES ('$user_id', '$book_id')");

        if ($result === true) {
            echo "success";
        } else {
            echo "Error: <br>" . $db->error;
        }
    }
?>