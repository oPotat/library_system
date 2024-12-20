-- Create the database
CREATE DATABASE Library;
USE Library;

-- Create the Book table
CREATE TABLE Book (
    ISBN BIGINT PRIMARY KEY,
    num_Copies BIGINT,
    title VARCHAR(255),
    edition BIGINT,
    publication_year BIGINT,
    price BIGINT
);

-- Create the Copy table
CREATE TABLE Copy (
    copy_id BIGINT AUTO_INCREMENT PRIMARY KEY, -- Auto-increment for MySQL
    book_id BIGINT,
    status VARCHAR(1),
    CONSTRAINT fk1 FOREIGN KEY (book_id) REFERENCES Book(ISBN)
);

-- Create the Category table
CREATE TABLE Category (
    cat_id BIGINT PRIMARY KEY,
    cat_name VARCHAR(20)
);

-- Create the Publisher table
CREATE TABLE Publisher (
    publisher_id BIGINT PRIMARY KEY,
    name VARCHAR(20),
    address VARCHAR(50),
    phone VARCHAR(20)
);

-- Create the Author table
CREATE TABLE Author (
    auth_id BIGINT PRIMARY KEY,
    first_name VARCHAR(20),
    middle_name VARCHAR(20),
    last_name VARCHAR(20)
);

-- Create the Borrower table
CREATE TABLE Borrower (
    borrower_num BIGINT PRIMARY KEY,
    first_name VARCHAR(20),
    last_name VARCHAR(20),
    phone VARCHAR(10),
    address VARCHAR(50)
);

-- Create the Publishes table
CREATE TABLE Publishes (
    publisher_id BIGINT,
    ISBN BIGINT PRIMARY KEY,
    FOREIGN KEY (publisher_id) REFERENCES Publisher(publisher_id),
    FOREIGN KEY (ISBN) REFERENCES Book(ISBN)
);

-- Create the Writes table
CREATE TABLE Writes (
    auth_id BIGINT,
    ISBN BIGINT,
    FOREIGN KEY (auth_id) REFERENCES Author(auth_id),
    FOREIGN KEY (ISBN) REFERENCES Book(ISBN)
);

-- Insert data into Publisher
INSERT INTO Publisher (publisher_id, name, address, phone) VALUES 
(1, 'Penguin Books', '375 Hudson St, New York, NY', '212-366-2000'),
(2, 'Random House', '1745 Broadway, New York, NY', '212-782-9000'),
(3, 'HarperCollins', '195 Broadway, New York, NY', '212-207-7000'),
(4, 'Simon & Schuster', '1230 Avenue of Americas, NY', '212-698-7000');

-- Insert data into Author
INSERT INTO Author (auth_id, first_name, middle_name, last_name) VALUES 
(1, 'Stephen', 'Edwin', 'King'),
(2, 'J.K.', NULL, 'Rowling'),
(3, 'George', 'R.R.', 'Martin'),
(4, 'Agatha', NULL, 'Christie'),
(5, 'Dan', NULL, 'Brown');

-- Insert data into Category
INSERT INTO Category (cat_id, cat_name) VALUES 
(1, 'Fiction'),
(2, 'Non-Fiction'),
(3, 'Mystery'),
(4, 'Science Fiction'),
(5, 'Fantasy');

-- Insert data into Book
INSERT INTO Book (ISBN, num_Copies, title, edition, publication_year, price) VALUES 
(9780316769174, 10, 'The Shining', 1, 1977, 15),
(9780747532743, 15, 'Harry Potter and the Philosopher''s Stone', 1, 1997, 20),
(9780553103540, 8, 'A Game of Thrones', 1, 1996, 25),
(9780062693662, 12, 'Murder on the Orient Express', 1, 1934, 18),
(9780307474278, 7, 'The Da Vinci Code', 1, 2003, 22);

-- Insert data into Publishes
INSERT INTO Publishes (publisher_id, ISBN) VALUES 
(1, 9780316769174),
(2, 9780747532743),
(3, 9780553103540),
(4, 9780062693662),
(2, 9780307474278);

-- Insert data into Writes
INSERT INTO Writes (auth_id, ISBN) VALUES 
(1, 9780316769174),
(2, 9780747532743),
(3, 9780553103540),
(4, 9780062693662),
(5, 9780307474278);

-- Insert data into Borrower
INSERT INTO Borrower (borrower_num, first_name, last_name, phone, address) VALUES 
(1, 'John', 'Doe', '5551234567', '123 Main St, Anytown, USA'),
(2, 'Jane', 'Smith', '5559876543', '456 Elm St, Somewhere, USA'),
(3, 'Michael', 'Johnson', '5552223333', '789 Oak Ave, Elsewhere, USA');

-- Insert data into Copy
INSERT INTO Copy (book_id, status) VALUES 
(9780316769174, 'A'),
(9780316769174, 'B'),
(9780747532743, 'A'),
(9780747532743, 'A'),
(9780553103540, 'B'),
(9780062693662, 'A'),
(9780307474278, 'B');
