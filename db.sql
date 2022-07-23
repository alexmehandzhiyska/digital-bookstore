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
('Alexandrina', 'Mehandzhiyska', 'alexandrina.mehandzhiyska1@gmail.com', '85136c79cbf9fe36bb9d05d0639c70c265c18d37', true),
('Ivan', 'Vazov', 'ivan@abv.bg', '85136c79cbf9fe36bb9d05d0639c70c265c18d37', false),
('Dante', 'Aleghieri', 'dante@abv.bg', '85136c79cbf9fe36bb9d05d0639c70c265c18d37', false);

CREATE TABLE authors (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    image VARCHAR(50),
    bio VARCHAR(5000)
);

INSERT INTO authors (first_name, last_name, image, bio)
VALUES 
('Ivan', 'Vazov', 'ivan_vazov.jpg', 'Иван Вазов е български поет, писател и драматург, наричан често „Патриарх на българската литература“. Творчеството на Вазов е отражение на две исторически епохи – Възраждането и следосвобожденска България.'),
('Yordan', 'Radichkov', 'yordan_radichkov.jpg', 'Роден е на 24 октомври 1929 г. в с. Калиманица, Монтанско. През 1947 г. завършва гимназия в Берковица. Работи като кореспондент (1951) и редактор (1952-1954) във вестник „Народна младеж“, редактор във в-к „Вечерни новини“ (1954-1960) и в „Българска кинематография“ (1960-1962), редактор и член на редакционната колегия на вестник „Литературен фронт“ (1962-1969). От 1973 до 1986 г. е съветник в Съвета за развитие на духовните ценности на обществото в Държавния съвет на Народна република България. От 1986 до 1989 г. е заместник-председател на Съюза на българските писатели.'),
('Emiliqn', 'Stanev', 'emiliqn_stanev.jpg', 'Истинското име на Емилиян Станев е Никола Стоянов Станев. Роден е в Търново на 28 февруари 1907 г. Детството си прекарва най-вече в градовете Търново и Елена, където живее дълго заедно със семейството си. От малък баща му започва да го води със себе си на лов сред природата и по-късно това дава отражение в произведенията му, където намираме често нейни описания. През 1928 г. завършва гимназия в град Враца като частен ученик, след което се премества в София и учи известно време живопис при проф. Цено Тодоров. През 30-те години записва финанси и кредит в Свободния университет за политически и стопански науки, (днес УНСС). През 1932 – 1944 г. работи като чиновник в Софийската община, а през 1945 г. е управител на ловно стопанство в с. Буковец, Ловешко. Станев е постоянен участник в близкото лично обкръжение на диктатора Тодор Живков, известно като „ловната дружинка“ и действащо като неформален съветнически щаб. Умира на 15 март 1979 г. и е погребан заедно с жена си Надежда Станева в гробищата на Велико Търново.');

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
('Pod igoto', 1, 'Historical novel', 1894, 'Роман из живота на българите в предвечерието на Освобождението. В три части. С 25 илюстрации в текста. „Под игото“ е роман в три части от българския писател Иван Вазов, цялостно публикуван за първи път през 1894 г. и определян като първият пример за този жанр в българската литература.', '9789542839415', 'Bulgarian', 565, 'pod_igoto.jpg',  15.90),
('Noev Kovcheg', 2, 'Fragmentary Novel', 1945, 'Ноев ковчег в стария завет на Библията (Битие 6-9 глава) е голям кораб („ковчег“), с размери 300 лакти (около 150 м) дължина, 50 лакти (около 25 м) ширина и 30 лакти (около 15 м) височина, който Ной построява по поръчение и по указания на Бог, за да спаси от Потопа себе си, семейството си и избрани двойки от различните видове животни („според рода им“).', '9359509865915', 'Bulgarian', 340, 'noev_kovcheg.jpg', 10),
('Antihrist', 3, 'Historical/Philosophical novel', 1936, 'Търновград набрал люде, а самият обеднял и посивял. Знат­ните се занимават повече с магии, отколкото с мо­литви, простите го ударили на безгрижие, кражби и просия, а царската власт линее и си стои настра­на, наслаждава се нашият застарял самодържец на боголюбиви слова, на изображения, на женска хубост и всякакви други хубости. И не ще знае кое е негово, кое е чуждо, та лесно ще го лъжат и ограбват. Защото познание, придобито с постоянно отрицание, се губи като вода под пясък и който нарича днес зла­тото желязо, а утре желязото – злато, е осъден на вечна бедност...', '9789542829553', 'Bulgarian', 268, 'antihrist.jpg', 14.90),
('Nie vrabchetata', 2, 'Children book', 1931, 'Една от най-обичаните детски книги на Йордан Радичков, „Ние,врабчетата“, излязла за първи път през 1968 година, продължава да радва децата и техните родители и днес. Книгата е с илюстрациите на автора.', '9786199093450', 'Bulgarian', 134, 'nie_vrabchetata.jpg', 15);

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

INSERT INTO orders (user_id, first_name, last_name, phone, address)
VALUES
    (1, 'Lubomira', 'Mehandzhiyska', '0878633906', 'Gurko Petkov 6, Blagoevgrad'),
    (3, 'Dante', 'Alighieri', '0876234567', 'Ivan Petkov 12, Sofia');

CREATE TABLE order_items (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    book_id INT NOT NULL,
    order_id INT NOT NULL,
    FOREIGN KEY (book_id) REFERENCES books(id),
    FOREIGN KEY (order_id) REFERENCES orders(id)
);

INSERT INTO order_items (book_id, order_id)
VALUES
    (3, 1),
    (1, 2),
    (2, 2);

CREATE TABLE cart_books (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

INSERT INTO cart_books (user_id, book_id)
VALUES
    (1, 3),
    (2, 1),
    (3, 3);

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
    (1, 1, 5);

CREATE TABLE wishlists (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

INSERT INTO wishlists (user_id, book_id)
VALUES
    (1, 3),
    (2, 2);