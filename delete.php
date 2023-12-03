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
            background-color: #FEFFDE; /* 배경색 변경 */
        }

        h2 {
            color: #52734D; /* 헤더 텍스트 색상 변경 */
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
            background-color: #91C788;
            color: #FEFFDE; /* 헤더 텍스트 색상 변경 */
        }

        input, button {
            padding: 8px;
            margin-right: 10px;
        }

        button {
            background-color: #52734D; /* 배경색 변경 */
            color: #FEFFDE; /* 텍스트 색상 변경 */
        }
    </style>
</head>
<body>
    <h2>데이터 삭제</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['searchCondition']) && isset($_GET['searchValue'])) {
        // MySQL 연결 설정
        $servername = "localhost";
        $username = "manager";
        $password = "1234";
        $dbname = "inventory_db";

        // GET으로 전달된 데이터 받기
        $searchCondition = $_GET['searchCondition'];
        $searchValue = $_GET['searchValue'];

        // MySQL 연결 생성
        $conn = new mysqli($servername, $username, $password, $dbname);

        // 연결 확인
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // 데이터베이스에서 데이터 검색
        $selectQuery = "SELECT * FROM items WHERE $searchCondition LIKE '%$searchValue%'";
        $result = $conn->query($selectQuery);

        if ($result->num_rows > 0) {
            echo "<h3>검색 결과</h3>";

            // 검색된 데이터를 출력
            echo "<form action='delete_result.php' method='post'>";
            echo "<table>";
            echo "<thead><tr><th></th><th>발주일</th><th>품목명</th><th>수량</th><th>단가</th><th>주문총액</th><th>주문한 학교명</th><th>공급사</th><th>메모</th></tr></thead>";
            echo "<tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td style='width: 20px;'><input type='checkbox' name='deleteItems[]' value='" . $row["id"] . "' /></td>"; // id로 수정, 가로 길이 조정
                echo "<td>" . $row["orderDate"] . "</td>";
                echo "<td>" . $row["itemName"] . "</td>";
                echo "<td>" . $row["itemQuantity"] . "</td>";
                echo "<td>" . $row["unitPrice"] . "</td>"; // 단가 추가
                echo "<td>" . $row["orderTotal"] . "</td>"; // 주문총액 추가
                echo "<td>" . $row["schoolName"] . "</td>"; // 주문한 학교명 추가
                echo "<td>" . $row["supplier"] . "</td>"; // 공급사 추가
                echo "<td>" . $row["memo"] . "</td>"; // 메모 추가
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
