<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/index.css">
    <link rel="stylesheet" href="../../styles/books.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ff09b572f7.js" crossorigin="anonymous"></script>
    <title>Digital Bookstore</title>
</head>
<body>
    <?php include '../layout/header.php' ?>

    <main>
        <h1 class="text-center my-5">All Books</h1>

        <section class="d-flex justify-content-around">
            <?php include '../../services/bookService.php' ?>
            <?php 
                $books = getAll();
                
                for ($i = 0; $i < sizeof($books); $i++) {
                    echo "
                        <article class='book d-flex flex-column align-items-center'>
                            <h4 class='mt-4'><a class='title-link' href='./bookDetails.php?id={$books[$i]['id']}'>{$books[$i]['title']}</a></h4>
                            <p class='mb-4'>{$books[$i]['first_name']} {$books[$i]['last_name']}</p>
                            <img src='../../assets/img/{$books[$i]['book_image']}' alt='Book image' class='book-img' />
                            <h5 class='my-2'>{$books[$i]['price']} lv.</h5>

                            <div class='btn btn-primary mb-3'>
                                <i class='fa-solid fa-cart-shopping mx-2'></i>
                                <span>Add to card</span>
                            </div>
                        </article>
                    ";
                }
            ?>
        </section>
    </main>

    <?php include '../layout/footer.php' ?>
</body>
</html>
