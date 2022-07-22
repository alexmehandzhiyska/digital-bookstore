<?php
    require('conf/db.conf.php');
    require('./classes/Utils.class.php');
    require('./classes/Wishlist.class.php');
    
    $wishlist_class = new Wishlist($pdo_conn);

    $book_id = $_GET['book_id'];
    $result = $wishlist_class->removeFromWishlist($book_id);

    if ($result === true) {
        echo "success";
    } else {
        echo "Error: <br>" . $db->error;
    }
?>