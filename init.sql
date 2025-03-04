-- Create the database
CREATE DATABASE IF NOT EXISTS vulnerable_app;
USE vulnerable_app;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    role ENUM('admin', 'customer') DEFAULT 'customer',
    otp VARCHAR(10) DEFAULT NULL
);

-- Create the products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

-- Create the orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_cost DECIMAL(10, 2),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create the order_items table (to store items in each order)
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Populate the users table with sample data
-- Admin user
INSERT INTO users (username, password, email, role) VALUES
('admin', MD5('admin123'), 'admin@example.com', 'admin');

-- Customer users
INSERT INTO users (username, password, email, role) VALUES
('customer1', MD5('customer123'), 'customer1@example.com', 'customer'),
('customer2', MD5('customer456'), 'customer2@example.com', 'customer'); -- New customer

-- Populate the products table with sample data
INSERT INTO products (name, price) VALUES
('Wireless Mouse', 25.99),
('Mechanical Keyboard', 89.99),
('Gaming Headset', 59.99),
('27-inch Monitor', 199.99),
('USB-C Hub', 35.99),
('External Hard Drive', 120.00),
('Bluetooth Speaker', 45.50),
('Smartwatch', 150.00),
('Laptop Stand', 29.99),
('Wireless Charger', 19.99);

-- Populate the orders table with sample data
-- Note: user_id should match an existing user in the users table
INSERT INTO orders (user_id, total_cost) VALUES
(2, 115.98), -- Order 1: Customer 1
(3, 249.98); -- Order 2: Customer 2 (new customer)

-- Populate the order_items table with sample data
-- Note: order_id and product_id should match existing orders and products
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 2, 25.99), -- Order 1: 2x Wireless Mouse
(1, 3, 1, 59.99), -- Order 1: 1x Gaming Headset
(2, 4, 1, 199.99), -- Order 2: 1x 27-inch Monitor
(2, 6, 1, 120.00); -- Order 2: 1x External Hard Drive