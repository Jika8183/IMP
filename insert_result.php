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
    </style>
</head>
<body>
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

        // MySQL 연결 생성
        $conn = new mysqli($servername, $username, $password, $dbname);

        // 연결 확인
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // 데이터베이스에 데이터 추가
        $sql = "INSERT INTO items (itemName, itemQuantity) VALUES ('$itemName', '$itemQuantity')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>데이터가 성공적으로 저장되었습니다.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        // 전체 목록 조회
        $selectQuery = "SELECT * FROM items";
        $result = $conn->query($selectQuery);

        if ($result->num_rows > 0) {
            echo "<h2>전체 저장된 목록</h2>";
            echo "<table>";
            echo "<thead><tr><th>품목명</th><th>수량</th></tr></thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["itemName"] . "</td><td>" . $row["itemQuantity"] . "</td></tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p>저장된 데이터가 없습니다.</p>";
        }

        // 버튼들
        echo '<button onclick="location.href=\'insert.php\'">추가하기</button>';
        echo '<button onclick="location.href=\'update_select.php\'">수정하기</button>';

        // 연결 종료
        $conn->close();
    }
    ?>
</body>
</html>
