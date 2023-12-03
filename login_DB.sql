DROP USER 'manager'@'%';
CREATE USER 'manager'@'%' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON *.* TO 'manager'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
-- users 테이블 생성 쿼리

CREATE DATABASE user_db;
USE user_db;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    rlrhks INT NOT NULL
);

-- 사용자 추가 예시
INSERT INTO users (userid, password, rlrhks) VALUES ('root', '0000', -1);
INSERT INTO users (userid, password, rlrhks) VALUES ('school1', '1111', 0);
INSERT INTO users (userid, password, rlrhks) VALUES ('school2', '1111', 0);
INSERT INTO users (userid, password, rlrhks) VALUES ('rmqtlr', '1111', 1);
INSERT INTO users (userid, password, rlrhks) VALUES ('rhdrmq1', '1111', 2);
INSERT INTO users (userid, password, rlrhks) VALUES ('rhqrmq2', '1111', 2);