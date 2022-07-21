<?php 
    function getAll() {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');
        $data = $db->query('SELECT books.id AS book_id, title, pages, books.image AS book_image, price, first_name, last_name FROM books JOIN authors ON books.author_id = authors.id');

        if ($data->num_rows  > 0) {
            $books = array();
    
            while($row = $data->fetch_assoc()) {
                $book = array("id"=>$row["book_id"], "title"=>$row["title"], "pages"=>$row["pages"], "first_name"=>$row["first_name"], "last_name"=>$row["last_name"], "book_image"=>$row["book_image"], "price"=>number_format($row["price"], 2));
                array_push($books, $book);
            }
    
            return $books;
        } else {
            return array();
        }
    }

    function getOne($id) {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');
        $data = $db->query("SELECT books.id AS book_id, title, description, genre, year_released, pages, ISBN, language, books.image AS book_image, price, first_name, last_name FROM books JOIN authors ON books.author_id = authors.id WHERE books.id = '$id'");

        $book = $data->fetch_assoc();
        return $book;
    }

    function getWishListBooks($user_id) {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

        $books_data = $db->query("SELECT books.id AS book_id, title, books.image AS book_image, price, first_name, last_name FROM books JOIN authors ON books.author_id = authors.id WHERE books.id IN (SELECT book_id FROM wishlists WHERE user_id = '$user_id')");
        
        if ($books_data->num_rows  > 0) {
            $books = array();
    
            while($row = $books_data->fetch_assoc()) {
                $book = array("id"=>$row["book_id"], "title"=>$row["title"], "first_name"=>$row["first_name"], "last_name"=>$row["last_name"], "book_image"=>$row["book_image"], "price"=>number_format($row["price"], 2));
                array_push($books, $book);
            }
    
            return $books;
        } else {
            return array();
        }
    }

    function checkIfWishlisted($user_id, $book_id) {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

        $book_data = $db->query("SELECT books.id FROM books WHERE books.id IN (SELECT book_id FROM wishlists WHERE user_id = '$user_id' AND book_id = '$book_id')");
        
        if ($book_data->num_rows  > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getBookRating($book_id) {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

        $ratings_data = $db->query("SELECT rating FROM ratings WHERE book_id = $book_id");
        $ratings = array();

        while($row = mysqli_fetch_array($ratings_data)) {
            array_push($ratings, $row['rating']);
        }

        $averageRating = array_sum($ratings) / count($ratings);
        return floor($averageRating);
    }

    function getUserRating($user_id, $book_id) {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

        $rating_data = $db->query("SELECT rating FROM ratings WHERE user_id = '$user_id' AND book_id = '$book_id'");
        
        if ($rating_data->num_rows  > 0) {
            $rating = $rating_data->fetch_assoc();
            return $rating['rating'];
        } else {
            return null;
        }
    }

    function getCartBooks($user_id) {
        $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

        $books_data = $db->query("SELECT books.id AS book_id, title, genre, books.image AS book_image, price, first_name, last_name FROM books JOIN authors ON books.author_id = authors.id WHERE books.id IN (SELECT book_id FROM cart_books WHERE user_id = '$user_id')");
        
        if ($books_data->num_rows  > 0) {
            $books = array();
    
            while($row = $books_data->fetch_assoc()) {
                $book = array("id"=>$row["book_id"], "title"=>$row["title"], "genre"=>$row["genre"], "first_name"=>$row["first_name"], "last_name"=>$row["last_name"], "book_image"=>$row["book_image"], "price"=>number_format($row["price"], 2));
                array_push($books, $book);
            }
    
            return $books;
        } else {
            return array();
        }
    }
?>
