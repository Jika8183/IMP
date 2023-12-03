-- inventory_DB.sql
DROP DATABASE IF EXISTS inventory_db;
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

-- ALTER TABLE items ADD COLUMN itemID INT AUTO_INCREMENT PRIMARY KEY FIRST;
INSERT INTO items (itemID, itemName, itemQuantity, orderDate, unitPrice, orderTotal, schoolName, supplier, memo)
VALUES
('오이', 10, '2023-01-01', 15.99, 159.90, 'OO초등학교', '햇살식품', '에'),
('고추', 5, '2023-01-02', 20.50, 102.50, 'ㅁㅁ초등학교', '햇살식품', '12'),
('배추', 8, '2023-01-03', 12.75, 102.00, 'XX초등학교', '햇살식품', '하');
SELECT* from items;
-- itemID 컬럼 추가