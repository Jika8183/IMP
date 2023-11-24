<!-- update_select.php -->
<!DOCTYPE html>
<html lang="ko">
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

        select, input, button {
            padding: 8px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h2>데이터 수정</h2>

    <form action="update.php" method="get">
        <label for="searchCondition">검색 조건 선택:</label>
        <select id="searchCondition" name="searchCondition" required>
            <option value="orderDate">발주일</option>
            <option value="itemName">품목</option>
            <option value="schoolName">학교명</option>
            <option value="supplier">공급사</option>
        </select>

        <label for="searchValue">검색어:</label>
        <div id="searchValueContainer"></div>

        <button type="submit">검색</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('searchCondition').addEventListener('change', function () {
                var searchValueContainer = document.getElementById('searchValueContainer');
                searchValueContainer.innerHTML = ''; // 기존 내용 비우기

                if (this.value === 'orderDate') {
                    var input = document.createElement('input');
                    input.type = 'date';
                    input.id = 'searchValue';
                    input.name = 'searchValue';
                    searchValueContainer.appendChild(input);
                } else {
                    var select = document.createElement('select');
                    select.id = 'searchValue';
                    select.name = 'searchValue';

                    // 여기에 각 조건에 맞게 옵션 추가
                    var option = document.createElement('option');
                    option.value = '옵션값';
                    option.text = '옵션 텍스트';
                    select.appendChild(option);

                    searchValueContainer.appendChild(select);
                }
            });
        });
    </script>
</body>
</html>
