<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/books.css">
    <link rel="stylesheet" href="../styles/wishlist.css">
    <link rel="stylesheet" href="../styles/rating.css">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ff09b572f7.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../scripts/books.js" type="module" defer></script>
    <title>Digital Bookstore</title>
</head>
<body>
    <?php include './layout/header.php' ?>

    <main>
        <section class="d-flex justify-content-around">
            <?php include '../services/bookService.php' ?>
            <?php 
                $id = $_GET['id'];
                $book = getOne($id);
                $average_rating = getBookRating($id);
                
                $email = $_SESSION['email'];
                $user_rating = getUserRating($email, $id);

                echo 
                "
                    <article class='details-book mt-5 d-flex align-items-center justify-content-center'>
                        <input type='hidden' value={$book['book_id']} />

                        <section class='px-5'>
                            <img src='../assets/img/{$book['book_image']}' alt='Book image' class='details-book-img' />
                        </section>

                        <section class='px-5'>
                            <h1 class='mt-5'>{$book['title']}</h1>
                            <div class='rating my-1'>
                ";

                for ($i = 1; $i <= 5; $i++) {
                    $star_id = 6 - $i;
                    
                    if ($user_rating) {
                        if ($star_id <= $average_rating) {
                            echo "<span class='rating-star-disabled'>☆</i></span>";
                        } else {
                            echo "<span class='rating-star-empty-disabled'>☆</i></span>";
                        }
                    } else {
                        if ($star_id <= $average_rating) {
                            echo "<span class='rating-star' id={$star_id}>☆</i></span>";
                        } else {
                            echo "<span class='rating-star rating-star-empty' id={$star_id}>☆</i></span>";
                        }
                    }
                    
                }

                if ($user_rating) {
                    echo "<p class='user-rating'>Your rating: {$user_rating}</p>";
                }
                
                echo
                "
                    </div>
                    <p class='my-4'>{$book['description']}</p>

                    <table class='table'>
                        <tr>
                            <td>Author</td>
                            <td>{$book['first_name']} {$book['last_name']}</td>
                        </tr>

                        <tr>
                            <td>Genre</td>
                            <td>{$book['genre']}</td>
                        </tr>

                        <tr>
                            <td>Release year</td>
                            <td>{$book['year_released']}</td>
                        </tr>

                        <tr>
                            <td>Pages</td>
                            <td>{$book['pages']}</td>
                        </tr>

                        <tr>
                            <td>ISBN</td>
                            <td>{$book['ISBN']}</td>
                        </tr>

                        <tr>
                            <td>Language</td>
                            <td>{$book['language']}</td>
                        </tr>
                    </table>

                    <h3 class='my-4'>{$book['price']} lv.</h3>

                    <div class='btn btn-primary mb-3'>
                        <i class='fa-solid fa-cart-shopping mx-2'></i>
                        <span id='add-to-cart-btn'>Add to cart</span>
                    </div>
                ";
                                              
                $is_wishlisted = checkIfWishlisted($email, $book['book_id']);

                if ($is_wishlisted === true) {
                    echo "<i class='mx-4 mb-3 fa-solid fa-heart' id='wishlist-btn-selected'></i>";
                } else {
                    echo "<i class='mx-4 mb-3 fa-solid fa-heart' id='wishlist-btn'></i>";
                }
                
                
                echo "</section></article>";
            ?>
        </section>
    </main>

    <?php include './layout/footer.php' ?>
</body>
</html>
