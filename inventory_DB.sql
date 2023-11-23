-- 데이터베이스 생성
CREATE DATABASE IF NOT EXISTS inventory_db;
USE inventory_db;

-- 테이블 생성
CREATE TABLE IF NOT EXISTS items (
    itemID INT AUTO_INCREMENT PRIMARY KEY,
    itemName VARCHAR(255) NOT NULL,
    itemQuantity INT NOT NULL
);

-- itemID 컬럼 추가
ALTER TABLE items ADD COLUMN itemID INT AUTO_INCREMENT PRIMARY KEY FIRST;
