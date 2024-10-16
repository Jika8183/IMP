<!-- delete_select.php -->
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
</style>
</head>
<body>
    <h2>데이터 삭제</h2>

    <!-- 데이터 검색을 위한 폼 -->
    <form action="delete.php" method="get">
        <label for="searchCondition">검색 조건 선택:</label>
        <select id="searchCondition" name="searchCondition" required>
            <option value="orderDate">발주일</option>
            <option value="itemName">품목</option>
            <option value="schoolName">학교명</option>
            <option value="supplier">공급사</option>
        </select>

        <label for="searchValue">검색어:</label>
        <div id="searchValueContainer">
            <!-- 이곳에 동적으로 생성된 옵션을 표시할 것입니다. -->
        </div>

        <button type="submit">검색</button>
    </form>

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
