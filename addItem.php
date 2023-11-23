<?php
// MySQL 연결 설정
$servername = "localhost"; // MySQL 서버 주소
$username = "manager"; // MySQL 사용자명
$password = "1234"; // MySQL 비밀번호
$dbname = "inventory_db"; // 사용할 데이터베이스명

// POST로 전달된 데이터 받기
$itemName = $_POST['itemName'];
$itemQuantity = $_POST['itemQuantity'];

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 데이터베이스에 데이터 추가
$sql = "INSERT INTO items (itemName, itemQuantity) VALUES ('$itemName', '$itemQuantity')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 연결 종료
$conn->close();
?>
