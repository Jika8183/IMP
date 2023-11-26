<!-- insert.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>데이터 추가</title>
    <!-- 부트스트랩 CDN 추가 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            margin-top: 20px;
        }

        label {
            margin-top: 10px;
        }

        button {
            margin-top: 20px;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-group-half {
            width: 48%; /* 반 너비 */
        }
    </style>
    <script>
        // JavaScript로 주문총액 계산
        function calculateOrderTotal() {
            var quantity = parseFloat(document.getElementById('itemQuantity').value);
            var unitPrice = parseFloat(document.getElementById('unitPrice').value);
            var orderTotal = quantity * unitPrice;

            if (!isNaN(orderTotal)) {
                document.getElementById('orderTotal').value = orderTotal.toFixed(2);
            }
        }

        
        // 현재 날짜를 가져오는 함수
        function getCurrentDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0'); // 0부터 시작하므로 1을 더하고, 2자리로 맞춤
            const day = String(today.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // 발주일 입력란의 기본값을 현재 날짜로 설정
        document.addEventListener('DOMContentLoaded', function () {
            const orderDateInput = document.getElementById('orderDate');
            orderDateInput.value = getCurrentDate();
        });
    
    </script>
</head>
<body>
    <div class="container">
        <h2>데이터 추가</h2>
        <form action="insert_result.php" method="post">
            <div class="form-group">
                <label for="orderDate">발주일:</label>
                <input type="date" class="form-control form-group-half" id="orderDate" name="orderDate" required />
            </div>

            <div class="form-group">
                <label for="itemSelect">품목 선택:</label>
                <select class="form-control form-group-half" id="itemSelect" name="itemSelect">
                    <option value="오이">오이</option>
                    <option value="고추">고추</option>
                    <option value="감자">감자</option>
                    <option value="백미">백미</option>
                    <option value="친환경쌀">친환경쌀</option>
                    <option value="잡곡">잡곡</option>
                    <option value="소고기">소고기</option>
                    <option value="토마호크">토마호크</option>
                    <option value="대방어">대방어</option>
                    <option value="고등어">고등어</option>

                    <!-- 다른 품목들도 필요에 따라 추가 -->
                </select>
            </div>

            <div class="form-group">
                <label for="itemQuantity">수량:</label>
                <input type="number" class="form-control form-group-half" id="itemQuantity" name="itemQuantity" required oninput="calculateOrderTotal()" />
            </div>

            <div class="form-group">
                <label for="unitPrice">단가(원):</label>
                <input type="number" class="form-control form-group-half" id="unitPrice" name="unitPrice" step="1" required oninput="calculateOrderTotal()" />
            </div>

            <div class="form-group">
                <label for="orderTotal">주문총액(원):</label>
                <input type="number" class="form-control form-group-half" id="orderTotal" name="orderTotal" step="1" readonly />
            </div>

            <div class="form-group">
                <label for="schoolName">주문한 학교명:</label>
                <select class="form-control form-group-half" id="schoolName" name="schoolName" required>
                    <option value="OO초등학교">OO초등학교</option>
                    <option value="ㅁㅁ초등학교">ㅁㅁ초등학교</option>
                    <option value="XX초등학교">XX초등학교</option>
                    <!-- 다른 학교들도 필요에 따라 추가 -->
                </select>
            </div>

            <div class="form-group">
                <label for="supplier">공급사:</label>
                <select class="form-control form-group-half" id="supplier" name="supplier" required>
                    <option value="햇살식품">햇살식품</option>
                    <option value="맛난정육">맛난정육</option>
                    <option value="싱싱수산">싱싱수산</option>
                    <option value="오가닉팜">오가닉팜</option>
                    <!-- 다른 공급사들도 필요에 따라 추가 -->
                </select>
            </div>

            <div class="form-group">
                <label for="memo">메모:</label>
                <textarea class="form-control" id="memo" name="memo"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">확인</button>
        </form>
    </div>
    <!-- 부트스트랩 스크립트 추가 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
