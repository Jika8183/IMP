<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>읽기 모드</title>
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
            display: flex;
            align-items: center;
        }
        label {
            margin-right: 10px;
            color: #52734D; /* 라벨 텍스트 색상 변경 */
        }

        select, input, button {
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #52734D; /* 테두리 스타일 변경 */
        }

        button {
        background-color: #52734D; /* 버튼 배경색 변경 */
        color: #FEFFDE; /* 버튼 텍스트 색상 변경 */
        cursor: pointer;
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
            color: #FEFFDE;
        }
    </style>
</head>
<body>
    

    <h2>읽기 모드</h2>
    <button onclick="location.href='mrhdrmq.php'">메인</button>
    <form action="mreading_mode.php" method="get"> <!-- 수정된 부분: action을 현재 페이지로 설정 -->
        <label for="searchCondition">검색 조건 선택:</label>
        <select id="searchCondition" name="searchCondition" required>
            <option value="supplier">공급사</option>
            <option value="orderDate">발주일</option>
            <option value="itemName">품목</option>
            <option value="schoolName">학교명</option>
        </select>

        <label for="searchValue">검색어:</label>
        <div id="searchValueContainer">
            <!-- 이곳에 동적으로 생성된 옵션을 표시할 것입니다. -->
        </div>

        <button type="submit">검색</button>
    </form>

    <!-- 검색된 데이터를 나타내는 테이블 -->
    <div id="searchResult">
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
                echo "<table>";
                echo "<thead><tr><th>발주일</th><th>품목명</th><th>수량</th><th>단가</th><th>주문총액</th><th>주문한 학교명</th><th>공급사</th><th>메모</th></tr></thead>";
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
                echo "<p>검색된 데이터가 없습니다.</p>";
            }

            // 연결 종료
            $conn->close();
        }
        ?>
    </div>
    <script>
        document.getElementById('searchCondition').addEventListener('change', function () {
            var searchValueContainer = document.getElementById('searchValueContainer');
            searchValueContainer.innerHTML = ''; // 기존 내용 비우기

            if (this.value === 'orderDate') {
                // 발주일 데이터 가져오기
                getDataAndPopulateSelect('get_dates.php');
            } else if (this.value === 'itemName') {
                // 품목 데이터 가져오기
                getDataAndPopulateSelect('get_items.php');
            } else if (this.value === 'schoolName') {
                // 학교명 데이터 가져오기
                getDataAndPopulateSelect('get_schools.php');
            } else if (this.value === 'supplier') {
                // 공급사 데이터 가져오기
                getDataAndPopulateSelect('get_suppliers.php');
            } else {
                // 다른 검색 조건에 대한 처리
                var input = document.createElement('input');
                input.type = 'text';
                input.id = 'searchValue';
                input.name = 'searchValue';
                searchValueContainer.appendChild(input);
            }
        });

        function getDataAndPopulateSelect(url) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var options = JSON.parse(xhr.responseText);

                    var select = document.createElement('select');
                    select.id = 'searchValue';
                    select.name = 'searchValue';

                    options.forEach(function (value) {
                        var option = document.createElement('option');
                        option.value = value;
                        option.text = value;
                        select.appendChild(option);
                    });

                    searchValueContainer.appendChild(select);
                }
            };

            xhr.open('GET', url, true);
            xhr.send();
        }

        // 초기 로딩 시에도 검색 조건에 따라 옵션을 표시
        document.getElementById('searchCondition').dispatchEvent(new Event('change'));
    </script> 
    
</body>
</html>
