<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../system/css/index.css">
    <link rel="stylesheet" href="../../system/css/wishlist.css">
    <link rel="stylesheet" href="../../system/css/books.css">
    <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ff09b572f7.js" crossorigin="anonymous"></script>
    <script src="../../system/js/wishlist.js" type="module" defer></script>
    <script src="../../system/js/cart.js" type="module" defer></script>
    <title>Digital Bookstore</title>
</head>
<body>
    <?php include './header.php' ?>

    <main>
        <h1 class="text-center my-5">Wishlist</h1>

        <section class="books d-flex justify-content-around">
            <?php 
                require('./conf/db.conf.php');
                require('./classes/Utils.class.php');
                require('./classes/Wishlist.class.php');
                
                $wishlist_class = new Wishlist($pdo_conn);
                $books = $wishlist_class->getByUser($_SESSION['user_id']);

                if (sizeof($books) > 0) {
                    for ($i = 0; $i < sizeof($books); $i++) {
                        $book = $books[$i];
                        $book_price = number_format($book['price'], 2);

                        echo "
                            <article class='book d-flex flex-column align-items-center'>
                                <input type='hidden' value={$book['book_id']} />
                                <h4 class='mt-4'><a class='link' href='/books/{$book['book_id']}'>{$book['title']}</a></h4>
                                <p class='mb-4'>{$book['first_name']} {$book['last_name']}</p>
                                <img src='../../images/{$book['book_image']}' alt='Book image' class='book-img' />
                                <h5 class='my-2'>{$book_price} lv.</h5>
    
                                <div class='add-to-cart-btn btn btn-primary mb-3'>
                                    <i class='fa-solid fa-cart-shopping mx-2'></i>
                                    <span>Add to card</span>
                                </div>
    
                                <div class='btn btn-outline-primary mb-3 remove-book-btn'>
                                    <span>Remove from wishlist</span>
                                </div>
                            </article>
                        ";
                    }
                } else {
                    echo "<p>You have not added any books to your wishlist yet!";
                }
            ?>
        </section>
    </main>

    <?php include './footer.php' ?>
</body>
</html>
