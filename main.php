<!-- main.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>재고 관리 프로그램</title>
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
    <h1>재고 관리 프로그램</h1>

    <form action="insert.php" method="get">
        <button type="submit">추가</button>
    </form>

    <form action="update_select.php" method="get">
        <button type="submit">수정</button>
    </form>

    <form action="delete_select.php" method="get">
        <button type="submit">삭제</button>
    </form>

    <table id="inventoryTable">
        <thead>
            <tr>
                <th>품목명</th>
                <th>수량</th>
            </tr>
        </thead>
        <tbody>
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

            // 연결 종료
            $conn->close();
        ?>
        </tbody>
    </table>
</body>
</html>
