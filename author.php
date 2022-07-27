<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../system/css/index.css">
    <link rel="stylesheet" href="../../system/css/books.css">
    <link rel="stylesheet" href="../../system/css/wishlist.css">
    <link rel="stylesheet" href="../../system/css/rating.css">
    <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ff09b572f7.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../system/js/wishlist.js" type="module" defer></script>
    <script src="../../system/js/rating.js" type="module" defer></script>
    <script src="../../system/js/cart.js" type="module" defer></script>
    <title>Digital Bookstore</title>
</head>
<body>
    <?php include './header.php' ?>

    <main>
        <section class="d-flex justify-content-around">
            <?php 
                require_once('conf/db.conf.php');
                require_once('classes/classes.inc');

                $book_class = new Book($pdo_conn);
                $author_class = new Author($pdo_conn);

                //Get author id from uri
                $path = $_SERVER['REQUEST_URI'];
                preg_match('/\d+/', $path, $id_array);
                $author_id = $id_array[0];

                $author = $author_class->getById($author_id);
                $author_books = $book_class->getByAuthor($author_id);
            
                echo 
                "
                    <article class='details-book pb-3 my-5 d-flex justify-content-center'>
                        <input type='hidden' value={$author['id']} />

                        <section class='px-5 my-5'>
                            <img src='../../images/{$author['image']}' alt='Book image' class='details-book-img' />
                        </section>

                        <section class='px-5'>
                            <h1 class='mt-5'>{$author['first_name']} {$author['last_name']}</h1>
                            <p class='my-4'>{$author['bio']}</p>
                            <article class='author-books d-flex justify-content-center'>
                ";

                $books_count = sizeof($author_books);

                if ($books_count > 0) {
                    for ($i = 0; $i < $books_count; $i++) {
                        $book = $author_books[$i];
                        
                        echo
                        "
                            <section class='px-3 d-flex flex-column align-items-center'>
                                <img class='author-book-img' src='../../images/{$book['book_image']}' alt='book-cover' />
                                <p><a href='/books/{$book['book_id']}' class='link'>{$book['title']}</a></p>
                            </section>
                        ";
                    }
                    echo "</article>";
                }
            ?>

                </section>
            </article>
        </section>
    </main>

    <?php include './footer.php' ?>
</body>
</html>