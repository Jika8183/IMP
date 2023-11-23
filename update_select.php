<!-- update_select.php -->
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
    <h2>데이터 수정</h2>

    <form action="update.php" method="get">
        <label for="searchItem">품목 검색:</label>
        <input type="text" id="searchItem" name="searchItem" required />

        <button type="submit">검색</button>
    </form>
</body>
</html>
