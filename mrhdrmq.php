<!-- main.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" type="image/x-icon" href="https://postimg.cc/zbQptXC7">
  
    <title>재고 관리 프로그램</title>
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
    <h1>재고 관리 프로그램</h1>
    <button onclick="location.href='mreading_mode.php'">읽기모드</button>
    <button onclick="location.href='login.php'">로그아웃</button>
</header>

<table id="inventoryTable">
    <thead>
        
        
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
                echo "<thead><tr><th>발주일</th><th>품목명</th><th>수량</th><th>단가</th><th>주문총액</th><th>주문한 학교명</th><th>공급사</th><th>메모</th></tr></thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["orderDate"] . "</td><td>" . $row["itemName"] . "</td><td>" . $row["itemQuantity"] . "</td>";
                    echo "<td>" . $row["unitPrice"] . "</td><td>" . $row["orderTotal"] . "</td>";
                    echo "<td>" . $row["schoolName"] . "</td><td>" . $row["supplier"] . "</td><td>" . $row["memo"] . "</td></tr>";
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
