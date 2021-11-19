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

INSERT INTO users (email, name_first, name_last, password) VALUES 
	('admin@ontariotechu.net', 'Ontario', 'Tech', '$2y$10$ShhmLiA0isK.9UBzeAp16.6aJmynQn0Wan/J72J1Um8XAVdUrtfN6'); # password is 'password'