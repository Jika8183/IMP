<!-- insert.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>데이터 추가</title>
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
    <h2>데이터 추가</h2>

    <form action="insert_result.php" method="post">
        <label for="itemSelect">품목 선택:</label>
        <select id="itemSelect" name="itemSelect">
            <option value="오이">오이</option>
            <option value="고추">고추</option>
            <option value="감자">감자</option>
            <!-- 다른 품목들도 필요에 따라 추가 -->
        </select>

        <label for="itemQuantity">수량:</label>
        <input type="number" id="itemQuantity" name="itemQuantity" required />

        <button type="submit">확인</button>
    </form>
</body>
</html>
