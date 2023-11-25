<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>데이터 수정 결과</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding-top: 70px; /* 헤더 높이만큼 여백 추가 */
        }

        header {
            position: fixed;
            width: 100%;
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
            top: 0;
            z-index: 1000; /* 다른 요소 위에 표시하기 위한 z-index 값 */
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
            background-color: #f2f2f2;
        }

        button {
            padding: 8px;
            margin-top: 10px;
            margin-right: 10px;
        }

        footer {
            position: fixed;
            width: 100%;
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <h2>데이터 수정 결과</h2>
    <button onclick="location.href='main.php'">메인</button>
    <button onclick="location.href='insert.php'">추가하기</button>
    <button onclick="location.href='update_select.php'">수정하기</button>
    <button onclick="location.href='delete_select.php'">삭제하기</button>
</header>

<?php
// POST로 전달된 데이터 확인
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $itemID = isset($_POST['itemID']) ? $_POST['itemID'] : '';
    $itemName = $_POST['itemName'];
    $itemQuantity = $_POST['itemQuantity'];
    $unitPrice = $_POST['unitPrice'];
    $orderTotal = $_POST['orderTotal'];
    $schoolName = $_POST['schoolName'];
    $supplier = $_POST['supplier'];
    $memo = $_POST['memo'];

    // 'itemID' 변수가 정의되어 있는지 확인
    if (!empty($itemID)) {
        // 데이터베이스에서 데이터 수정
        $updateQuery = "UPDATE items SET 
                        itemName='$itemName', 
                        itemQuantity=$itemQuantity, 
                        unitPrice=$unitPrice, 
                        orderTotal=$orderTotal, 
                        schoolName='$schoolName', 
                        supplier='$supplier', 
                        memo='$memo' 
                        WHERE id=$itemID";

        // 쿼리 실행 결과 확인
        if ($conn->query($updateQuery) === TRUE) {
            echo "<br />";
            echo "데이터가 성공적으로 수정되었습니다.";
        } else {
            echo "Error: " . $updateQuery . "<br>" . $conn->error;
        }
    } else {
        echo "수정할 데이터를 찾을 수 없습니다.";
    }

    // 전체 목록 조회
    $selectQuery = "SELECT * FROM items";
    $result = $conn->query($selectQuery);

    // 조회 결과가 있는 경우 테이블로 표시
    if ($result->num_rows > 0) {
        echo "<h2>전체 저장된 목록</h2>";
        echo "<table>";
        echo "<thead><tr><th>날짜</th><th>품목명</th><th>수량</th><th>단가</th><th>주문총액</th><th>학교명</th><th>공급사</th><th>메모</th></tr></thead>";
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
