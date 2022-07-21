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
                    <input type="text" id="first_name" name="first_name" class="form-control" />
                    <label class="form-label" for="first_name">First name</label>
                </div>
                </div>
                <div class="col">
                <div class="form-outline">
                    <input type="text" id="last_name" name="last_name" class="form-control" />
                    <label class="form-label" for="last_name">Last name</label>
                </div>
                </div>
            </div>

            <div class="form-outline mb-4">
                <input type="text" id="address" name="address" class="form-control" />
                <label class="form-label" for="address">Address</label>
            </div>

            <div class="form-outline mb-4">
                <input type="number" id="phone" name="phone" class="form-control" />
                <label class="form-label" for="phone">Phone</label>
            </div>

            <div class="form-outline mb-4">
                <textarea class="form-control" id="additional_info" name="additional_info" rows="4"></textarea>
                <label class="form-label" for="additional_info">Additional information</label>
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
        if (isset($_POST['order'])) {
            $db = new mysqli('localhost', 'root', '', 'digital-bookstore');
            
            $first_name = $db->real_escape_string($_POST['first_name']);
            $last_name = $db->real_escape_string($_POST['last_name']);
            $address = $db->real_escape_string($_POST['address']);
            $phone = $db->real_escape_string($_POST['phone']);
            $additional_information = $db->real_escape_string($_POST['additional_info']);

            $email = $db->real_escape_string($_POST['email']);

            $user_data = $db->query("SELECT id, first_name FROM users WHERE email = '$email'");
            $user = $user_data->fetch_assoc();
            $user_id = $user['id'];

            $order_result = $db->query("INSERT INTO orders (user_id, first_name, last_name, address, phone, additional_information) VALUES ('$user_id', '$first_name', '$last_name', '$address', '$phone', '$additional_information')");

            if ($order_result === true) {
                $order_id = $db->insert_id;
            } else {
                echo $db->error;
                return;
            }

            $order_items_data = $db->query("SELECT book_id FROM cart_books WHERE user_id = '$user_id'");

            while($row = mysqli_fetch_array($order_items_data)) {
                $book_id = $row['book_id'];
                $order_items_result = $db->query("INSERT INTO order_items (book_id, order_id) VALUES ($book_id, $order_id)");
            }

            $cart_data = $db->query("DELETE FROM cart_books WHERE user_id = $user_id");
            
            if ($cart_data === true) {
                echo 'success';
            } else {
                echo $db->error;
            }
        }
    ?>
</body>
</html>
