<!-- delete_result.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>데이터 삭제 결과</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding-top: 70px; /* 헤더 높이만큼 여백 추가 */
            background-color: #FEFFDE; /* 추가 */
        }

        header {
            position: fixed;
            width: 100%;
            background-color: #91C788; /* 변경 */
            padding: 10px;
            text-align: center;
            top: 0;
            z-index: 1000; /* 다른 요소 위에 표시하기 위한 z-index 값 */
        }

        h1 {
            color: #52734D; /* 추가 */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #91C788; /* 변경 */
            color: #FEFFDE; /* 추가 */
        }

        form {
            margin-top: 20px;
        }

        input, button {
            padding: 8px;
            margin-right: 10px;
        }

        footer {
            position: fixed;
            width: 100%;
            background-color: #91C788; /* 변경 */
            padding: 10px;
            text-align: center;
            bottom: 0;
            color: #FEFFDE; /* 추가 */
        }
    </style>
</head>
<body>

<header>
    <h2>데이터 삭제 결과</h2>
    <button onclick="location.href='main.php'">메인</button>
    <button onclick="location.href='insert.php'">추가하기</button>
    <button onclick="location.href='update_select.php'">수정하기</button>
    <button onclick="location.href='delete_select.php'">삭제하기</button>
</header>

<?php
// POST로 전달된 데이터 확인
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteItems'])) {
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

    // POST로 전달된 데이터 받기
    $deleteItems = isset($_POST['deleteItems']) ? $_POST['deleteItems'] : array();

    // 배열에 있는 모든 아이템 삭제
    foreach ($deleteItems as $itemID) {
        // 데이터베이스에서 데이터 삭제
        $deleteQuery = "DELETE FROM items WHERE id = $itemID"; // id로 수정

        // 쿼리 실행 결과 확인
        if ($conn->query($deleteQuery) !== TRUE) {
            echo "Error: " . $deleteQuery . "<br>" . $conn->error;
        }
    }

    echo "선택한 데이터가 성공적으로 삭제되었습니다.";

    // 전체 목록 조회
    $selectQuery = "SELECT * FROM items";
    $result = $conn->query($selectQuery);

    // 조회 결과가 있는 경우 테이블로 표시
    if ($result->num_rows > 0) {
    
        echo "<h2>전체 저장된 목록</h2>";
        echo "<table>";
        echo "<thead><tr><th>날짜</th><th>품목명</th><th>수량</th><th>단가</th><th>주문총액</th><th>주문한 학교명</th><th>공급사</th><th>메모</th></tr></thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["orderDate"] . "</td>";
            echo "<td>" . $row["itemName"] . "</td>";
            echo "<td>" . $row["itemQuantity"] . "</td>";
            echo "<td>" . $row["unitPrice"] . "</td>";
            echo "<td>" . $row["orderTotal"] . "</td>";
            echo "<td>" . $row["schoolName"] . "</td>";
            echo "<td>" . $row["supplier"] . "</td>";
            echo "<td>" . $row["memo"] . "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>저장된 데이터가 없습니다.</p>";
    }

    // 연결 종료
    $conn->close();
}
?>

</body>
</html>
