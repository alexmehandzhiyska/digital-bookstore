<?php
    if (isset($_POST['book_id'])) {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

        $book_id = $_POST['book_id'];
        $user_id = $_POST['user_id'];

        $result = $db->query("INSERT INTO wishlists (user_id, book_id) VALUES ('$user_id', '$book_id')");

        if ($result === true) {
            echo "success";
        } else {
            echo "Error: <br>" . $db->error;
        }
    }
?>