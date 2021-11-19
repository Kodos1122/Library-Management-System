DROP DATABASE IF EXISTS library;
CREATE DATABASE library;
USE library;

CREATE TABLE users (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name_first VARCHAR(255) NOT NULL,
    name_last VARCHAR(255) NOT NULL,
    password BINARY(60) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW()
);

CREATE TABLE publishers (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE authors (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name_first VARCHAR(100) NOT NULL, 
    name_middle VARCHAR(50), 
    name_last VARCHAR(100)
);

CREATE TABLE genres (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL, 
    parent_id INTEGER UNSIGNED REFERENCES genres(id)
);

CREATE TABLE books (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL, 
    pages INTEGER UNSIGNED, 
    rating DECIMAL(4, 2), 
    isbn VARCHAR(13), 
    published_at DATE, 
    publisher_id INTEGER UNSIGNED REFERENCES publishers(id)
);

CREATE TABLE book_authors (
    book_id INTEGER UNSIGNED NOT NULL REFERENCES books(id), 
    author_id INTEGER UNSIGNED NOT NULL REFERENCES authors(id), 
    PRIMARY KEY(book_id, author_id)
);

CREATE TABLE book_genres (
    book_id INTEGER UNSIGNED NOT NULL REFERENCES books(id), 
    genre_id INTEGER UNSIGNED NOT NULL REFERENCES genres(id), 
    PRIMARY KEY(book_id, genre_id)
);

INSERT INTO users (email, name_first, name_last, password) VALUES 
    ('admin@ontariotechu.net', 'Ontario', 'Tech', '$2y$10$ShhmLiA0isK.9UBzeAp16.6aJmynQn0Wan/J72J1Um8XAVdUrtfN6'); # password is 'password'