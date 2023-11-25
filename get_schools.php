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

// 학교명 데이터 가져오기
$query = "SELECT DISTINCT schoolName FROM items";
$result = $conn->query($query);

$schoolOptions = array();
while ($row = $result->fetch_assoc()) {
    $schoolOptions[] = $row['schoolName'];
}

$conn->close();

// JSON 형식으로 반환
echo json_encode($schoolOptions);
?>
