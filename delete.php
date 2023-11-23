<!-- delete.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>데이터 삭제</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-top: 20px;
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

        input, button {
            padding: 8px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h2>데이터 삭제</h2>

    <?php
    // 검색 폼에서 데이터를 받아오기
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

            // 검색된 데이터를 출력
            echo "<form action='delete_result.php' method='post'>";
            echo "<table>";
            echo "<thead><tr><th>품목명</th><th>수량</th><th>선택</th></tr></thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["itemName"] . "</td>";
                echo "<td>" . $row["itemQuantity"] . "</td>";
                echo "<td><input type='checkbox' name='deleteItems[]' value='" . $row["itemID"] . "' /></td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
            echo "<button type='submit'>선택한 데이터 삭제</button>";
            echo "</form>";
        } else {
            echo "<p>검색된 데이터가 없습니다.</p>";
        }

        // 연결 종료
        $conn->close();
    }
    ?>
</body>
</html>
