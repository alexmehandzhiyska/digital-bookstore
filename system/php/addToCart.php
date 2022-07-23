<?php
    require('conf/db.conf.php');
    require('./classes/Utils.class.php');
    require('./classes/Cart.class.php');

    $cart_class = new Cart($pdo_conn);


    if (isset($_POST['book_id'])) {
        $result = $cart_class->addToCart($_POST['book_id']);

        if ($result) {
            echo 'success';
        } 

        echo null;
    }
?>