CREATE DATABASE Library 

CREATE TABLE Book(
ISBN bigint  PRIMARY KEY,
num_Copies bigint ,
title VARCHAR(255),
edition bigint ,
publication_year bigint ,
price bigint 
)

CREATE TABLE Copy(
copy_id bigint  PRIMARY KEY,
book_id bigint  ,
status VARCHAR(1),
CONSTRAINT fk1 FOREIGN KEY (book_id) REFERENCES Book(ISBN),
)

CREATE TABLE Category(
cat_id /* :3 */ bigint  PRIMARY KEY,
cat_name /* :3 */ VARCHAR(20)
)

CREATE TABLE Publisher (
publisher_id bigint  Primary Key,
name VARCHAR(20),
address VARCHAR(50),
phone VARCHAR(20)
)

CREATE TABLE Author( 
auth_id bigint  PRIMARY KEY,
first_name VARCHAR(20),
middle_name VARCHAR(20),
last_name VARCHAR(20)
)

CREATE TABLE Borrower(
  borrower_num bigint  PRIMARY KEY,
  first_name VARCHAR(20),
  last_name VARCHAR(20),
  phone VARCHAR(10),
  address VARCHAR(50)
)

CREATE TABLE Publishes (
publisher_id bigint ,
ISBN bigint  PRIMARY KEY
)

CREATE TABLE Writes (
auth_id bigint ,
ISBN bigint 
CONSTRAINT fk2 FOREIGN KEY (auth_id) REFERENCES Author(auth_id),
CONSTRAINT fk3 FOREIGN KEY (ISBN) REFERENCES Book(ISBN)
)

-- Insert Publishers
INSERT INTO Publisher (publisher_id, name, address, phone) VALUES 
(1, 'Penguin Books', '375 Hudson St, New York, NY', '212-366-2000'),
(2, 'Random House', '1745 Broadway, New York, NY', '212-782-9000'),
(3, 'HarperCollins', '195 Broadway, New York, NY', '212-207-7000'),
(4, 'Simon & Schuster', '1230 Avenue of Americas, NY', '212-698-7000');

-- Insert Authors
INSERT INTO Author (auth_id, first_name, middle_name, last_name) VALUES 
(1, 'Stephen', 'Edwin', 'King'),
(2, 'J.K.', NULL, 'Rowling'),
(3, 'George', 'R.R.', 'Martin'),
(4, 'Agatha', NULL, 'Christie'),
(5, 'Dan', NULL, 'Brown');

-- Insert Categories
INSERT INTO Category (cat_id, cat_name) VALUES 
(1, 'Fiction'),
(2, 'Non-Fiction'),
(3, 'Mystery'),
(4, 'Science Fiction'),
(5, 'Fantasy');

-- Insert Books
INSERT INTO Book (ISBN, num_Copies, title, edition, publication_year, price) VALUES 
(9780316769174, 10, 'The Shining', 1, 1977, 15),
(9780747532743, 15, 'Harry Potter and the Philosopher''s Stone', 1, 1997, 20),
(9780553103540, 8, 'A Game of Thrones', 1, 1996, 25),
(9780062693662, 12, 'Murder on the Orient Express', 1, 1934, 18),
(9780307474278, 7, 'The Da Vinci Code', 1, 2003, 22);

-- Insert Publishes
INSERT INTO Publishes (publisher_id, ISBN) VALUES 
(1, 9780316769174),
(2, 9780747532743),
(3, 9780553103540),
(4, 9780062693662),
(2, 9780307474278);

-- Insert Writes
INSERT INTO Writes (auth_id, ISBN) VALUES 
(1, 9780316769174),
(2, 9780747532743),
(3, 9780553103540),
(4, 9780062693662),
(5, 9780307474278);

-- Insert Borrowers
INSERT INTO Borrower (borrower_num, first_name, last_name, phone, address) VALUES 
(1, 'John', 'Doe', '5551234567', '123 Main St, Anytown, USA'),
(2, 'Jane', 'Smith', '5559876543', '456 Elm St, Somewhere, USA'),
(3, 'Michael', 'Johnson', '5552223333', '789 Oak Ave, Elsewhere, USA');

-- Insert Copies
INSERT INTO Copy (copy_id, book_id, status) VALUES 
(1, 9780316769174, 'A'),
(2, 9780316769174, 'B'),
(3, 9780747532743, 'A'),
(4, 9780747532743, 'A'),
(5, 9780553103540, 'B'),
(6, 9780062693662, 'A'),
(7, 9780307474278, 'B');