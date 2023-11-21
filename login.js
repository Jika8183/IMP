document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // 가상 로그인: 사용자명과 기관을 세션 스토리지에 저장
    var selectedOrganization = document.getElementById('organization').value;
    var username = document.getElementById('username').value;

    sessionStorage.setItem('loggedIn', 'true');
    sessionStorage.setItem('organization', selectedOrganization);
    sessionStorage.setItem('username', username);

    // 로그인 후 재고관리 페이지로 이동
    window.location.href = 'IMP.html'; // IMP.html은 재고관리 페이지로 가정
});

  //위의 JavaScript 코드에서는 사용자가 로그인 폼을 제출하면 가상으로 세션 스토리지에 로그인 정보를 저장한 후 재고관리 페이지로 이동하고 있습니다. 이는 가상의 방식이며, 실제로는 백엔드에서 사용자를 인증하고 세션을 생성하여 안전하게 관리해야 합니다.

//프로덕션 환경에서는 백엔드 서버를 사용하여 사용자를 인증하고 세션을 안전하게 관리하는 것이 중요합니다. 일반적으로는 Passport.js 등을 사용하여 로그인 및 사용자 인증을 처리하게 됩니다.