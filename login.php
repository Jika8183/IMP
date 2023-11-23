<?php
// MySQL 연결 정보
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "login_DB";

// POST로 전송된 사용자 입력 값 가져오기
$organization = $_POST['organization'];
$username = $_POST['username'];
$password = $_POST['password'];

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 입력된 사용자 정보를 이용하여 로그인 처리
$sql = "SELECT * FROM users WHERE organization = '$organization' AND username = '$username'";
$result = $conn->query($sql);

// 결과 확인
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // 비밀번호 검증
    if (password_verify($password, $hashed_password)) {
        if ($row['is_admin'] == 1) {
            // 관리자 계정으로 로그인 성공
            echo "관리자로 로그인 성공!";
            
            // 로그인 성공 시 IMP.html로 리다이렉션
            header("Location: IMP.html");
            exit();
        } else {
            // 일반 사용자 계정으로 로그인 성공
            echo "일반 사용자로 로그인 성공!";
        }
    } else {
        // 비밀번호 불일치
        echo "로그인 실패: 비밀번호가 일치하지 않습니다.";
    }
} else {
    // 로그인 실패
    echo "로그인 실패: 사용자 정보가 일치하지 않습니다.";
}

// 연결 종료
$conn->close();
?>
