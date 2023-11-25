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

// 품목 데이터 가져오기
$query = "SELECT DISTINCT itemName FROM items";
$result = $conn->query($query);

$itemOptions = array();
while ($row = $result->fetch_assoc()) {
    $itemOptions[] = $row['itemName'];
}

$conn->close();

// JSON 형식으로 반환
echo json_encode($itemOptions);
?>
