<!-- insert_result.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>데이터 추가 결과</title>
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
    <h2>데이터 추가 결과</h2>
    <button onclick="location.href='main.php'">메인</button>
    <button onclick="location.href='insert.php'">추가하기</button>
    <button onclick="location.href='update_select.php'">수정하기</button>
    <button onclick="location.href='delete_select.php'">삭제하기</button>
</header>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // MySQL 연결 설정
    $servername = "localhost";
    $username = "manager";
    $password = "1234";
    $dbname = "inventory_db";

    // POST로 전달된 데이터 받기
    $itemName = $_POST['itemSelect'];
    $itemQuantity = $_POST['itemQuantity'];
    $orderDate = $_POST['orderDate'];
    $unitPrice = $_POST['unitPrice'];
    $orderTotal = $itemQuantity * $unitPrice; // 주문총액 계산

    // 학교명과 공급사는 POST로 받아오기
    $schoolName = $_POST['schoolName'];
    $supplier = $_POST['supplier'];
    $memo = $_POST['memo'];

    // MySQL 연결 생성
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 연결 확인
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 데이터베이스에 데이터 추가
    $sql = "INSERT INTO items (itemName, itemQuantity, orderDate, unitPrice, orderTotal, schoolName, supplier, memo) 
            VALUES ('$itemName', '$itemQuantity', '$orderDate', '$unitPrice', '$orderTotal', '$schoolName', '$supplier', '$memo')";

    if ($conn->query($sql) === TRUE) {
        $lastInsertedID = $conn->insert_id; // 새로 추가된 레코드의 itemID 얻기

        echo "<p>데이터가 성공적으로 저장되었습니다. 추가된 아이템 ID: $lastInsertedID</p>";
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    // 전체 목록 조회
    $selectQuery = "SELECT * FROM items";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        echo "<h2>전체 저장된 목록</h2>";
        echo "<table>";
        echo "<thead><tr><th>발주일</th><th>품목명</th><th>수량</th><th>단가(원)</th><th>주문총액(원)</th><th>주문한 학교명</th><th>공급사</th><th>메모</th></tr></thead>";
        echo "<tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["orderDate"] . "</td><td>" . $row["itemName"] . "</td>";
            echo "<td>" . $row["itemQuantity"] . "</td><td>" . $row["unitPrice"] . "</td>";
            echo "<td>" . $row["orderTotal"] . "</td><td>" . $row["schoolName"] . "</td>";
            echo "<td>" . $row["supplier"] . "</td><td>" . $row["memo"] . "</td></tr>";
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
