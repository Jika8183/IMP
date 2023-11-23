<!-- update.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>데이터 수정</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-top: 20px;
        }

        input, button {
            padding: 8px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h2>데이터 수정</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['searchItem'])) {
        // MySQL 연결 설정
        $servername = "localhost";
        $username = "manager";
        $password = "1234";
        $dbname = "inventory_db";

        // GET으로 전달된 데이터 받기
        $searchItem = $_GET['searchItem'];

        // MySQL 연결 생성
        $conn = new mysqli($servername, $username, $password, $dbname);

        // 연결 확인
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // 데이터베이스에서 데이터 검색
        $selectQuery = "SELECT * FROM items WHERE itemName LIKE '%$searchItem%'";
        $result = $conn->query($selectQuery);

        if ($result->num_rows > 0) {
            echo "<h3>검색 결과</h3>";

            while ($row = $result->fetch_assoc()) {
                echo "<form action='update_result.php' method='post'>";
                echo "<input type='hidden' name='itemID' value='" . $row["id"] . "' />";
                echo "<label for='itemName'>품목명:</label>";
                echo "<input type='text' id='itemName' name='itemName' value='" . $row["itemName"] . "' required />";
                echo "<label for='itemQuantity'>수량:</label>";
                echo "<input type='number' id='itemQuantity' name='itemQuantity' value='" . $row["itemQuantity"] . "' required />";
                echo "<button type='submit'>수정</button>";
                echo "</form>";
            }
        } else {
            echo "<p>검색된 데이터가 없습니다.</p>";
        }

        // 연결 종료
        $conn->close();
    }
    ?>
</body>
</html>
