CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(50) NOT NULL,
    is_admin BOOLEAN DEFAULT false
);

INSERT INTO users (first_name, last_name, email, password, is_admin)
VALUES 
('Alexandrina', 'Mehandzhiyska', 'alexandrina.mehandzhiyska1@gmail.com', '$sdfa82UP6a43lkj', true);

CREATE TABLE authors (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    image VARCHAR(50),
    bio VARCHAR(5000)
);

INSERT INTO authors (first_name, last_name, image, bio)
VALUES 
('Ivan', 'Vazov', 'ivan_vazov.jpg', 'Иваан Вазов е български поет, писател и драматург, наричан често „Патриарх на българската литература“. Творчеството на Вазов е отражение на две исторически епохи – Възраждането и следосвобожденска България.'),
('William', 'Faulkner', 'william_faulkner.jpg', 'William Faulkner was an American writer known for his novels and short stories set in the fictional Yoknapatawpha County, based on Lafayette County, Mississippi, where Faulkner spent most of his life. A Nobel Prize laureate, Faulkner is one of the most celebrated writers of American literature and is widely considered the greatest writer of Southern literature.'),
('Yordan', 'Radichkov', 'yordan_radichkov.jpg', 'Йордан Димитров Радичков е български писател, драматург и сценарист, представител на магическия реализъм.');

CREATE TABLE books (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    author_id INT NOT NULL,
    genre VARCHAR(30) NOT NULL,
    year_released INT,
    description VARCHAR(5000),
    ISBN VARCHAR(13) NOT NULL,
    language VARCHAR(30) NOT NULL,
    pages INT,
    image VARCHAR(50),
    price FLOAT NOT NULL,
    FOREIGN KEY(author_id) REFERENCES authors(id)
);

INSERT INTO books (title, author_id, genre, year_released, description, ISBN, language, pages, image, price)
VALUES 
('Под игото', 1, 'History', 1894, 'Роман из живота на българите в предвечерието на Освобождението. В три части. С 25 илюстрации в текста. „Под игото“ е роман в три части от българския писател Иван Вазов, цялостно публикуван за първи път през 1894 г. и определян като първият пример за този жанр в българската литература.', '9789542839415', 'Bulgarian', 565, 'pod_igoto.jpg',  15.90),
('Ноев ковчег', 3, 'Novel', 1945, 'Ноев ковчег в стария завет на Библията (Битие 6-9 глава) е голям кораб („ковчег“), с размери 300 лакти (около 150 м) дължина, 50 лакти (около 25 м) ширина и 30 лакти (около 15 м) височина, който Ной построява по поръчение и по указания на Бог, за да спаси от Потопа себе си, семейството си и избрани двойки от различните видове животни („според рода им“).', '9359509865915', 'Bulgarian', 340, 'noev_kovcheg.jpg', 10);

CREATE TABLE authors_books (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    author_id INT NOT NULL,
    book_id INT NOT NULL,
    FOREIGN KEY(author_id) REFERENCES authors(id),
    FOREIGN KEY(book_id) REFERENCES books(id)
);

CREATE TABLE orders (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(14) NOT NULL,
    address VARCHAR(100) NOT NULL,
    additional_information TEXT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    book_id INT NOT NULL,
    order_id INT NOT NULL,
    price FLOAT NOT NULL,
    FOREIGN KEY (book_id) REFERENCES books(id),
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE cart_books (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

CREATE TABLE ratings (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    rating INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

INSERT INTO ratings (user_id, book_id, rating)
VALUES
    (1, 1, 5),
    (1, 2, 3);