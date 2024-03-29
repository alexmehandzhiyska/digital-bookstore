<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../system/css/index.css">
    <link rel="stylesheet" href="../../node_modules/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ff09b572f7.js" crossorigin="anonymous"></script>
    <script src="../../system/js/register.js" type="module" defer></script>
    <title>Digital Bookstore</title>
</head>
<body>
    <?php include './header.php' ?>

    <main>
        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                        <form id="register-form" class="mx-1 mx-md-4" method="POST">

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                    <label class="form-label" for="first_name">First Name</label>
                                                    <input type="text" id="first_name" name="first_name" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                    <label class="form-label" for="last_name">Last Name</label>
                                                    <input type="text" id="last_name" name="last_name" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                    <label class="form-label" for="email">Your Email</label>
                                                    <input type="email" id="email" name="email" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                    <label class="form-label" for="password">Password</label>
                                                    <input type="password" id="password" name="password" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="form-outline flex-fill mb-0">
                                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                    <label class="form-label" for="repeat_password">Repeat your password</label>
                                                    <input type="password" id="repeat_password" name="repeat_password" class="form-control" />
                                                </div>
                                            </div>

                                            <p class="error-message"></p>

                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                <input type="submit" class="btn btn-primary btn-lg" value="Register" />
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include './footer.php' ?>

    <?php
        require_once('init.inc');

        if (isset($_POST['login'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = hash('sha1', $_POST['password']);
            $repeat_password = $_POST['repeat_password'];

            $user_class = new User($pdo_conn);
            
            $result = $user_class->registerUser($first_name, $last_name, $email, $password);

            if ($result) {
                $user_id = $result;

                $_SESSION['logged_in'] = '1';
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $user_id;
                echo 'success' . $user_id;
            } else {
                echo $result;
            }

        }
    ?>
</body>
</html>
