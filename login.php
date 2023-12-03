<?php
// 데이터베이스 연결 설정
$servername = "localhost";
$username = "manager";
$password = "1234";
$dbname = "user_db";  // 이 부분을 생성한 데이터베이스 이름으로 수정

$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 오류 체크
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// POST로 전송된 아이디와 비밀번호 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST["userid"];
    $password = $_POST["password"];

    // SQL 쿼리 작성
    $sql = "SELECT * FROM users WHERE userid = '$userid' AND password = '$password'";
    
    // 쿼리 실행
    $result = $conn->query($sql);
    
    // 결과 검사
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $rlrhks = $user['rlrhks'];
        
        // rlrhks 값에 따라 리디렉션
        if ($rlrhks == 0) {
            header("Location: mschool.php");
            exit();
        } elseif ($rlrhks == 1) {
            header("Location: main.php");
            exit();
        } elseif ($rlrhks == 2) {
            header("Location: mrhdrmq.php");
            exit();
        } else {
        echo "아이디 또는 비밀번호가 잘못되었습니다.";
        }
    }
}

// 데이터베이스 연결 종료
$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_styles.css">
    <link rel="icon" type="images/png" href="rogo.png">
    <style>
        body {
            background-color: #FEFFDE;
        }

        .login h2 {
            border-bottom: 2px solid #52734D;
            color: #52734D;
        }

        .login button {
            background-color: #91C788;
        }
    </style>
    <title>로그인</title>
</head>
<body>

<div class="logo-container">
    <img src="images/rogo.png" alt="로고" style="width: 400px; height: auto;">
</div>

<section class="login">
    <h2>로그인</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <ul>
            <li><input type="text" name="userid" placeholder="아이디" title="아이디입력"></li>
            <li><input type="password" name="password" placeholder="비밀번호" title="비밀번호입력"></li>
            <li><button type="submit">로그인</button></li>
        </ul>
    </form>
</section>

</body>
</html>