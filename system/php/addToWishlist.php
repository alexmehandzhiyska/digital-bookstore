<?php
    require('conf/db.conf.php');
    require('./classes/Utils.class.php');
    require('./classes/Wishlist.class.php');

    $wishlist_class = new Wishlist($pdo_conn);

    if (isset($_POST['book_id'])) {
        $result = $wishlist_class->addToWishlist($_POST['book_id']);

        if ($result) {
            echo 'success';
        }
        
        echo null;
    }
?>