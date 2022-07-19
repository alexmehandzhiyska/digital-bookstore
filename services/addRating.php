<?php
    if (isset($_POST['book_id'])) {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

        $book_id = $_POST['book_id'];
        $email = $_POST['email'];
        $rating = $_POST['rating'];

        $data = $db->query("SELECT id, first_name FROM users WHERE email = '$email'");
        $user = $data->fetch_assoc();
        $user_id = $user['id'];

        $rating_data = $db->query("SELECT rating FROM ratings WHERE user_id = '$user_id' AND book_id = '$book_id'");

        if ($rating_data->num_rows > 0) {
            echo $book_id;
        } else {
            $result = $db->query("INSERT INTO ratings (user_id, book_id, rating) VALUES ('$user_id', '$book_id', '$rating')");

            if ($result === true) {
                echo $book_id;
            } else {
                echo "Error: <br>" . $db->error;
            }
        }
    }
?>