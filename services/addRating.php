<?php
    if (isset($_POST['book_id'])) {
        $path = $_SERVER['REQUEST_URI'];
        preg_match('/\d+/', $path, $id_array);
        $book_id = $id_array[0];

        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

        $book_id = $_POST['book_id'];
        $user_id = $_POST['user_id'];
        $rating = $_POST['rating'];

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