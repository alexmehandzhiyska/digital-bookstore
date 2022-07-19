<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
        <div class="container-fluid">
            <a class="navbar-brand mx-5" href="/">Digital Bookstore</a>

            <ul class="navbar-nav mx-5 me-flex align-items-center mb-2 mb-lg-0">
                <li class="nav-item mx-3">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>

                <?php 
                    if (isset($_SESSION['logged_in'])) {
                        echo '
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="/books">Browse Books</a>
                            </li>

                            <li class="nav-item mx-3">
                                <a class="nav-link" href="/wishlist">Wishlist</a>
                            </li>

                            <li class="nav-item mx-3">
                                <a class="nav-link" href="/logout">Logout</a>
                            </li>
                            
                            <li class="nav-item mx-3 ">
                                <a class="nav-link" href="/cart">
                                    <i class="fa-solid fa-cart-shopping fa-lg my-1"></i>
                                </a>    
                            </li>
                            ';
                    } else {
                        echo '
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="/login">Login</a>
                            </li>
            
                            <li class="nav-item mx-3">
                                <a class="nav-link" href="/register">Register</a>
                            </li>
                        ';
                    }
                ?>
                
            </ul>
        </div>
    </nav>
</header>