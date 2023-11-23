<!-- delete_action.php -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // MySQL 연결 설정
    $servername = "localhost";
    $username = "manager";
    $password = "1234";
    $dbname = "inventory_db";

    // MySQL 연결 생성
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 연결 확인
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // POST로 전달된 데이터 받기
    $itemID = isset($_POST['itemID']) ? $_POST['itemID'] : '';
    

    // 데이터베이스에서 해당 품목 삭제
    if (!empty($itemID)) {
        $deleteQuery = "DELETE FROM items WHERE itemID = $itemID";

        // 디버깅: SQL 쿼리 출력
        echo "Debug: SQL Query: $deleteQuery";

        if ($conn->query($deleteQuery) === TRUE) {
            echo "데이터가 성공적으로 삭제되었습니다.";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "Error: itemID가 전달되지 않았습니다.";
    }

    // 연결 종료
    $conn->close();
}
?>
