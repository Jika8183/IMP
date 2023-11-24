-- inventory_DB.sql

CREATE DATABASE IF NOT EXISTS inventory_db;
USE inventory_db;

CREATE TABLE IF NOT EXISTS items (
    itemID INT AUTO_INCREMENT PRIMARY KEY,
    itemName VARCHAR(255) NOT NULL,
    itemQuantity INT NOT NULL,
    orderDate DATE,
    unitPrice DECIMAL(10,2),
    orderTotal DECIMAL(10,2),
    schoolName VARCHAR(255),
    supplier VARCHAR(255),
    memo TEXT
);


-- itemID 컬럼 추가
ALTER TABLE items ADD COLUMN itemID INT AUTO_INCREMENT PRIMARY KEY FIRST;
