
CREATE DATABASE IF NOT EXISTS e_co;

USE e_co;

-- e-commerce

CREATE TABLE users(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL, 
    email VARCHAR(255) NOT NULL ,
    password VARCHAR(255) NOT NULL ,
    role VARCHAR(60) NOT NULL
);

CREATE TABLE products(
    id INT  AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL, 
    price DOUBLE NOT NULL ,
    available BOOLEAN NOT NULL DEFAULT 0,
    description TEXT NOT NULL
);

ALTER TABLE products ADD COLUMN image VARCHAR(255) NOT NULL;


INSERT INTO users (firstname, lastname, email, password, role)
VALUES 
('John', 'Doe', 'john.doe@example.com', 'password123', 'admin'),
('Jane', 'Doe', 'jane.doe@example.com', 'password456', 'editor'),
('Bob', 'Smith', 'bob.smith@example.com', 'password789', 'author');


-- make a users table
