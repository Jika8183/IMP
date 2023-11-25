<?php
$servername = "localhost";
$username = "manager";
$password = "1234";
$dbname = "inventory_db";

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 발주일 데이터 가져오기
$query = "SELECT DISTINCT DATE_FORMAT(orderDate, '%Y-%m-%d') AS orderDate FROM items";
$result = $conn->query($query);

$dateOptions = array();
while ($row = $result->fetch_assoc()) {
    $dateOptions[] = $row['orderDate'];
}

$conn->close();

// JSON 형식으로 반환
header('Content-Type: application/json');
echo json_encode($dateOptions);
?>
