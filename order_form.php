<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../system/css/index.css">
    <link rel="stylesheet" href="../../system/css/cart.css">
    <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ff09b572f7.js" crossorigin="anonymous"></script>
    <script src="../../system/js/orders.js" type="module" defer></script>
    <title>Digital Bookstore</title>
</head>
<body>
    <?php include './header.php' ?>

    <main class="d-flex flex-column align-items-center">
        <h1 class="text-center my-5">Order Information</h1>

        <form id="order-form" method="POST">
            <div class="row mb-4">
                <div class="col">
                <div class="form-outline">
                    <label class="form-label" for="first_name">First name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" />
                </div>
                </div>
                <div class="col">
                <div class="form-outline">
                    <label class="form-label" for="last_name">Last name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" />
                </div>
                </div>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="phone">Phone</label>
                <input type="number" id="phone" name="phone" class="form-control" />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="additional_info">Additional information</label>
                <textarea class="form-control" id="additional_info" name="additional_info" rows="4"></textarea>
            </div>

            <div class="d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center align-items-center btn btn-primary btn-block mb-5" id="place-order-btn"> 
                    <i class="fa-solid fa-cart-arrow-down px-2"></i>
                    <input type="submit" class="place-order-input my-0 px-2" value="Place order" />
                </div>
            </div>
        </form>
    </main>

    <?php include './footer.php' ?>

    <?php
        require('./conf/db.conf.php');
        require('./classes/Utils.class.php');
        require('./classes/Order.class.php');
        require('./classes/Cart.class.php');

        $order_class = new Order($pdo_conn);
        $cart_class = new Cart($pdo_conn);

        if (isset($_POST['order'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $additional_information = $_POST['additional_info'];

            $order_result = $order_class->addOrder($first_name, $last_name, $address, $phone, $additional_information);
            $order_items_result = $order_class->addOrderItems($order_result);
            $cart_result = $cart_class->resetCart();

            if ($order_result && $order_items_result && $cart_result) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
    ?>
</body>
</html>
