<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/books.css">
    <link rel="stylesheet" href="../styles/cart.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ff09b572f7.js" crossorigin="anonymous"></script>
    <script src="../scripts/books.js" type="module" defer></script>
    <title>Digital Bookstore</title>
</head>
<body>
    <?php include './layout/header.php' ?>

    <main class='d-flex flex-column align-items-center'>
        <h1 class="text-center my-5">Shopping Cart</h1>

        <section class="d-flex justify-content-around">
            <?php include '../services/bookService.php' ?>
            <?php 
                $books = getCartBooks($_SESSION['email']);
                $total_price = 0;
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
                    $total_price += $books[$i]['price'];

                    echo "
                        <tr>
                            <td><img class='cart-book-img' src='../assets/img/{$books[$i]['book_image']}' /></td>
                            <td><a class='title-link' href='./bookDetails.php?id={$books[$i]['id']}'>{$books[$i]['title']}</a></td>
                            <td>{$books[$i]['first_name']} {$books[$i]['last_name']}</td>
                            <td>{$books[$i]['genre']}</td>
                            <td>{$books[$i]['price']} lv.</td>
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
                        <a href='orderForm.php' class='order-form-btn'>Proceed to order form</a>
                    </div>
                ";
            ?>
        </section>
    </main>

    <?php include './layout/footer.php' ?>
</body>
</html>
