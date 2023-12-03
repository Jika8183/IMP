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
        background-color: #FEFFDE; /* 이쁜 배경색으로 변경 */
    }

    form {
        margin-top: 20px;
    }

    input, button {
        padding: 8px;
        margin-right: 10px;
        border: 1px solid #52734D; /* 테두리 색상 변경 */
        background-color: #FEFFDE; /* 배경색 변경 */
       
    }

    .result-container {
        display: flex;
        flex-wrap: wrap;
    }

    .result-item {
        margin: 10px;
        padding: 10px;
        border: 1px solid #ccc; /* 테두리 색상 변경 */
        background-color: #DDFFBC; /* 배경색 변경 */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); /* 그림자 효과 추가 */
    }
</style>

     <script>
       function calculateOrderTotal() {
            var quantity = parseFloat(document.getElementById('itemQuantity').value);
         var unitPrice = parseFloat(document.getElementById('unitPrice').value);
          var orderTotal = quantity * unitPrice;

         if (!isNaN(orderTotal)) {
               document.getElementById('orderTotal').value = orderTotal.toFixed(2);
         }
        }

    </script>
</head>
<body>
    <h2>데이터 수정</h2>

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
            echo "<div class='result-container'>";

            while ($row = $result->fetch_assoc()) {
                echo "<div class='result-item'>";
                echo "<form action='update_result.php' method='post'>";
                echo "<input type='hidden' name='itemID' value='" . $row["id"] . "' />";
                
                echo "<label for='orderDate'>발주일:   </label>";
                echo "<input type='date' id='orderDate' name='orderDate' value='" . $row["orderDate"] . "' required /><br />";
                
                // 품목 선택
                echo "<label for='itemName'>품목 선택:</label>";
                echo "<select id='itemName' name='itemName'>";
                $items = array("오이", "고추", "감자", "백미", "친환경쌀", "잡곡", "소고기", "토마호크", "대방어", "고등어");

                foreach ($items as $item) {
                    $selected = ($item == $row["itemName"]) ? "selected" : "";
                    echo "<option value='$item' $selected>$item</option>";
                }

                echo "</select><br />";


                echo "<label for='itemQuantity'>수량:     </label>";
                echo "<input type='number' id='itemQuantity' name='itemQuantity' value='" . $row["itemQuantity"] . "' required /><br />";
                
                echo "<label for='unitPrice'>단가:     </label>";
                echo "<input type='number' id='unitPrice' name='unitPrice' value='" . $row["unitPrice"] . "' required /><br />";
                
                echo "<label for='orderTotal'>주문총액: </label>";
                echo "<input type='number' id='orderTotal' name='orderTotal' value='" . $row["orderTotal"] . "' required /><br />";
                
                // 학교명 선택
                echo "<label for='schoolName'>주문한 학교명:</label>";
                echo "<select id='schoolName' name='schoolName' required>";
                $schools = array("OO초등학교", "ㅁㅁ초등학교", "XX초등학교"); // 필요에 따라 데이터베이스에서 가져오도록 변경
                foreach ($schools as $school) {
                    $selected = ($school == $row["schoolName"]) ? "selected" : "";
                    echo "<option value='$school' $selected>$school</option>";
                }
                echo "</select><br />";
                
                // 공급사 선택
                echo "<label for='supplier'>공급사:</label>";
                echo "<select id='supplier' name='supplier' required>";
                $suppliers = array("햇살식품", "맛난정육", "싱싱수산", "오가닉팜"); // 필요에 따라 데이터베이스에서 가져오도록 변경
                foreach ($suppliers as $supplier) {
                    $selected = ($supplier == $row["supplier"]) ? "selected" : "";
                    echo "<option value='$supplier' $selected>$supplier</option>";
                }
                echo "</select><br />";
                
                echo "<label for='memo'>메모:     </label>";
                echo "<textarea id='memo' name='memo'>" . $row["memo"] . "</textarea><br />";
                
                echo "<button type='submit'>수정</button>";
                echo "</form>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "<p>검색된 데이터가 없습니다.</p>";
        }

        // 연결 종료
        $conn->close();
    }
    ?>
</body>
</html>
