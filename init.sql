CREATE DATABASE vulnerable_app;
USE vulnerable_app;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Weakly hashed (MD5)
    mfa_status BOOLEAN DEFAULT FALSE,
    email VARCHAR(100) NOT NULL,
    otp VARCHAR(10) DEFAULT NULL
);

-- Products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

-- Orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_cost DECIMAL(10, 2),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

ALTER TABLE users ADD COLUMN role ENUM('admin', 'customer') DEFAULT 'customer';

-- Admin user
INSERT INTO users (username, password, email, role) VALUES ('admin', MD5('admin123'), 'admin@example.com', 'admin');

-- Customer user
INSERT INTO users (username, password, email, role) VALUES ('customer', MD5('customer123'), 'customer@example.com', 'customer');

INSERT INTO users (username, password, email, role) VALUES ('customer', MD5('customer123'), 'customer@example.com', 'customer');
INSERT INTO users (username, password, email, role) VALUES ('customer', MD5('customer123'), 'customer@example.com', 'customer');
INSERT INTO users (username, password, email, role) VALUES ('customer', MD5('customer123'), 'customer@example.com', 'customer');