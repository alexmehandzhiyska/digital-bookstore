<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
        <div class="container-fluid">
            <a class="navbar-brand mx-5" href="home.php">Digital Bookstore</a>

            <ul class="navbar-nav mx-5 me-flex align-items-center mb-2 mb-lg-0">
                <li class="nav-item mx-3">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>

                <?php 
                    session_start();
                    if (isset($_SESSION['logged_in'])) {
                        echo '
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="bookList.php">Browse Books</a>
                            </li>

                            <li class="nav-item mx-3">
                                <a class="nav-link" href="wishlist.php">Wishlist</a>
                            </li>

                            <li class="nav-item mx-3">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                            
                            <li class="nav-item mx-3 ">
                                <i class="fa-solid fa-cart-shopping fa-lg my-1"></i>
                            </li>
                            ';
                    } else {
                        echo '
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
            
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                        ';
                    }
                ?>
                
            </ul>
        </div>
    </nav>
</header>