<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css">
    <link rel="stylesheet" href="../styles/cart.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ff09b572f7.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../scripts/books.js" defer></script>
    <title>Digital Bookstore</title>
</head>
<body>
    <?php include './layout/header.php' ?>

    <main class="d-flex flex-column align-items-center">
        <h1 class="text-center my-5">Order Information</h1>

        <form id="order-form" method="POST">
            <div class="row mb-4">
                <div class="col">
                <div class="form-outline">
                    <input type="text" id="first_name" class="form-control" />
                    <label class="form-label" for="first_name">First name</label>
                </div>
                </div>
                <div class="col">
                <div class="form-outline">
                    <input type="text" id="last_name" class="form-control" />
                    <label class="form-label" for="last_name">Last name</label>
                </div>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" id="address" class="form-control" />
                <label class="form-label" for="address">Address</label>
            </div>

            <!-- Number input -->
            <div class="form-outline mb-4">
                <input type="number" id="phone" class="form-control" />
                <label class="form-label" for="phone">Phone</label>
            </div>

            <!-- Message input -->
            <div class="form-outline mb-4">
                <textarea class="form-control" id="additional_information" rows="4"></textarea>
                <label class="form-label" for="additional_information">Additional information</label>
            </div>

            <!-- Submit button -->
            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center align-items-center btn btn-primary btn-block mb-5" id="place-order-btn"> 
                    <i class="fa-solid fa-cart-arrow-down px-2"></i>
                    <p class="my-0 px-2">Place order</p>
                </div>
            </div>
        </form>
    </main>

    <?php include './layout/footer.php' ?>
</body>
</html>
