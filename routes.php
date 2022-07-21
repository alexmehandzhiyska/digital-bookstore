<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

// In the URL -> http://localhost
get('/', 'index.php');

get('/register', 'register.php');
post('/register', 'register.php');
get('/login', 'login.php');
post('/login', 'login.php');
get('/logout', 'logout.php');

get('/books', 'book_list.php');
get('/books/$id', 'book_details.php');

post('/books/$id/rating', 'system/php/addRating.php');

get('/cart', 'cart.php');
post('/cart', 'system/php/addToCart.php');

get('/order', 'order_form.php');
post('/order', 'order_form.php');

get('/wishlist', 'wishlist.php');
post('/wishlist', 'system/php/addToWishlist.php');
delete('/wishlist', 'system/php/removeFromWishlist.php');

any('/404','404.php');
