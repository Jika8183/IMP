<!-- get_filtered_data.php -->

<?php
// MySQL 연결 설정
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

// 초기값 설정
$searchCondition = isset($_GET['searchCondition']) ? $_GET['searchCondition'] : '';
$searchValue = isset($_GET['searchValue']) ? $_GET['searchValue'] : '';

// 검색 조건에 따른 WHERE 절 설정
$whereClause = '';
if ($searchCondition && $searchValue) {
    $whereClause = "$searchCondition LIKE '%$searchValue%'";
}

// 데이터베이스에서 데이터 검색
$selectQuery = "SELECT * FROM items";
if ($whereClause) {
    $selectQuery .= " WHERE $whereClause";
}

$result = $conn->query($selectQuery);

// 결과를 JSON 형식으로 반환
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

// 연결 종료
$conn->close();
?>
