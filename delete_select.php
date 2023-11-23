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
    <h2>데이터 삭제</h2>

    <!-- 데이터 검색을 위한 폼 -->
    <form action="delete.php" method="get">
        <label for="searchItem">검색할 품목:</label>
        <input type="text" id="searchItem" name="searchItem" required />
        <button type="submit">검색</button>
    </form>
</body>
</html>
