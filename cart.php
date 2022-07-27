<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../system/css/index.css">
    <link rel="stylesheet" href="../../system/css/books.css">
    <link rel="stylesheet" href="../../system/css/cart.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ff09b572f7.js" crossorigin="anonymous"></script>
    <title>Digital Bookstore</title>
</head>
<body>
    <?php include './header.php' ?>

    <main class='d-flex flex-column align-items-center'>
        <h1 class="text-center my-5">Shopping Cart</h1>

        <section class="d-flex justify-content-around">
            <?php 
                require_once('conf/db.conf.php');
                require_once('classes/classes.inc');
            
                $cart_class = new Cart($pdo_conn);
                $books = $cart_class->getByUser($_SESSION['user_id']);
                $total_price = 0;

                if (sizeof($books) > 0) {
                    echo "
                    <table class='cart-table table table-striped'>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>";
            
                    for ($i = 0; $i < sizeof($books); $i++) {
                        $book = $books[$i];
                        $total_price += $book['price'];
                        $book_price = number_format($book['price'], 2);

                        echo "
                            <tr>
                                <td><img class='cart-book-img' src='../../images/{$book['book_image']}' /></td>
                                <td><a class='link' href='./bookDetails.php?id={$book['book_id']}'>{$book['title']}</a></td>
                                <td>{$book['first_name']} {$book['last_name']}</td>
                                <td>{$book['genre']}</td>
                                <td>{$book_price} lv.</td>
                            </tr>
                        ";
                    }

                    $total_price = number_format($total_price, 2);
                    
                    echo "
                                </tbody>

                                <tfoot>
                                    <td colspan='3'></td>
                                    <td><b>Total price</b></td>
                                    <td>{$total_price} lv .</td>
                                </tfoot>
                            </table>
                        </section>

                        <div id='finalize-order-btn' class='btn btn-primary mt-5'>
                            <i class='fa-solid fa-arrow-right px-2'></i>
                            <a href='/order' class='order-form-btn'>Proceed to order form</a>
                        </div>
                    ";
                } else {
                    echo "<p>You have not added any books to your cart yet!</p>";
                }
            ?>
        </section>
    </main>

    <?php include './footer.php' ?>
</body>
</html>
