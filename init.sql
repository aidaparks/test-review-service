CREATE DATABASE IF NOT EXISTS task
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE task;

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS clients
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS reviews
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    rating TINYINT NOT NULL,
    comment TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_reviews_client
        FOREIGN KEY (client_id) REFERENCES clients(id)
            ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO clients (name)
VALUES
    ('Иван Иванов'),
    ('Петр Петров'),
    ('Анна Смирнова'),
    ('Сергей Сидоров'),
    ('Мария Кузнецова');
