<?php
    require('conf/db.conf.php');
    require('./classes/Utils.class.php');
    require('./classes/Rating.class.php');
    
    if (isset($_POST['book_id'])) {
        $book_id = $_POST['book_id'];
        $rating = $_POST['rating'];

        $rating_class = new Rating($pdo_conn);
        $result = $rating_class->addRating($book_id, $rating);

        if ($result === true) {
            echo $book_id;
        } else {
            echo 'error';
        }
    }
?>