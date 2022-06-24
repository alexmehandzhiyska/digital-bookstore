<?php 
    $db = new mysqli('localhost', 'root', '', 'digital-bookstore');

    $data = $db->query('SELECT title, pages, books.image AS book_image, price, first_name, last_name FROM books JOIN authors ON books.author_id = authors.id');

    if ($data->num_rows  > 0) {
        $books = array();

        while($row = $data->fetch_assoc()) {
            $book = array("title"=>$row["title"], "pages"=>$row["pages"], "first_name"=>$row["first_name"], "last_name"=>$row["last_name"], "book_image"=>$row["book_image"], "price"=>number_format($row["price"], 2));
            array_push($books, $book);
        }

        return $books;
    } else {
        return array();
    }
?>
