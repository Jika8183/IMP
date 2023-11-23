-- 데이터베이스 생성
CREATE DATABASE IF NOT EXISTS your_database_name;
USE your_database_name;

-- 사용자 테이블 생성
CREATE TABLE IF NOT EXISTS users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  organization VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  is_admin BOOLEAN NOT NULL DEFAULT 0
);

-- 각 기관의 관리자 계정 추가
INSERT INTO users (organization, username, password, is_admin)
VALUES
    ('공공급식센터', 'admin1', '1111', 1),
    ('학교', 'admin2', '2222', 1),
    ('교육청', 'admin3', '3333', 1);
