window.onload = (event) => {
    localStorage.clear("state");
    isLogin();
};

function isLogin() {
    getState();
    setTimeout(function () {
        if (localStorage.getItem('isLogin') == "false" || localStorage.getItem('isLogin') == null) {
            window.location.replace("./components/login.html");
        } else {
            window.location.replace("./components/dashboard.php");
        }
    }, 3000);
}
