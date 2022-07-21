<?php
    $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

    $book_id = $_GET['book_id'];
    $user_id = $_SESSION['user_id'];

    $result = $db->query("DELETE FROM  wishlists  WHERE user_id = '$user_id' AND book_id = '$book_id'");

    if ($result === true) {
        echo "success";
    } else {
        echo "Error: <br>" . $db->error;
    }
?>