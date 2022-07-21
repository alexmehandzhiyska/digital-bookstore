<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

// In the URL -> http://localhost
get('/', 'index.php');

get('/register', 'views/auth/register.php');
post('/register', 'views/auth/register.php');
get('/login', 'views/auth/login.php');
post('/login', 'views/auth/login.php');
get('/logout', 'views/auth/logout.php');

get('/books', 'views/books/bookList.php');
get('/books/$id', 'views/books/bookDetails.php');

post('/books/$id/rating', 'services/addRating.php');

get('/cart', 'views/orders/cart.php');
post('/cart', 'services/addToCart.php');

get('/order', 'views/orders/orderForm.php');
post('/order', 'views/orders/orderForm.php');

get('/wishlist', 'views/wishlist/wishlist.php');
post('/wishlist', 'services/addToWishlist.php');
delete('/wishlist', 'services/removeFromWishlist.php');

any('/404','views/notFound.php');
