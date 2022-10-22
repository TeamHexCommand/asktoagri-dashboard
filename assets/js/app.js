const apiBaseUrl = "https://crafty.planckstudio.in/api/v1/";

$(document).ready(function () {
    $('#login-btn').on('click', function (e) {
        userLogin();
    });

    $('#logout-btn').on('click', function (e) {
        userLogout();
    });

    $('#userEditUpdate').on('click', function (e) {

        var newsletter = 0;

        if ($("#userEditNewsletter").prop('checked')) {
            newsletter = 1;
        }

        var data = {
            "name": $("#userEditDialogName").text(),
            "email": $("#userEditDialogEmail").text(),
            "mobile": "",
            "status": $("#userEditStatus").val(),
            "newsletter": newsletter.toString(),
            "points": $("#userEditPoints").val(),
            "id": $('#userEditUpdate').attr("uid")
        }

        console.log(data);

        updateUserInfo(data);
    });
});

function updateUserInfo(data) {
    var settings = {
        "url": "https://crafty.planckstudio.in/api/v1/",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Cookie": "PHPSESSID=4602228f627a660c5e9734f7cd24090d"
        },
        "data": JSON.stringify({
            "type": "update",
            "param": {
                "task": "userInfo",
                "data": data
            }
        }),
    };

    $.ajax(settings).done(function (response) {
        if (response.result === null) {
            swal({
                title: 'User information updated',
                text: 'Refreshing in few moments',
                type: 'success',
                confirmButtonText: 'Sure'
            })

            setTimeout(function () {
                location.reload();
            }, 2000);

        }
    });
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function userLogout() {

    localStorage.clear();
    localStorage.setItem('isLogin', "false");

    swal({
        title: 'Logout Successfull',
        text: 'Redirecting in few moments',
        type: 'success',
        confirmButtonText: 'Sure'
    })

    setTimeout(function () {
        if (localStorage.getItem('isLogin')) {
            window.location.replace("../components/login.html");
        }
    }, 2000);
}

Number.prototype.round = function (places) {
    return +(Math.round(this + "e+" + places) + "e-" + places);
}

function userLogin() {

    localStorage.setItem('isLogin', "true");
    localStorage.setItem('failedLoginAttempt', 0);

    swal({
        title: 'Access granted',
        text: 'Redirecting in few moments',
        type: 'success',
        confirmButtonText: 'Sure'
    })
    setTimeout(function () {
        if (localStorage.getItem('isLogin')) {
            window.location.replace("../components/dashboard.php");
        }
    }, 2000);

    // var email = $('input[name=auth_user]').val();
    // var pass = $('input[name=auth_pass]').val();

    // if (email != "" && pass != "") {
    //     var settings = {
    //         "url": apiBaseUrl,
    //         "method": "POST",
    //         "timeout": 0,
    //         "headers": {
    //             "Content-Type": "application/json",
    //             "Accept": "*/*",
    //             "Crafty-User-Type": "admin",
    //         },
    //         "data": JSON.stringify({
    //             "type": "get",
    //             "param": {
    //                 "task": "checkUserLogin",
    //                 "data": {
    //                     "user_email": email,
    //                     "user_password": pass
    //                 }
    //             }
    //         }),
    //     };

    //     $.ajax(settings).done(function (response) {
    //         console.log(response.status);
    //         if (response.status == "OK" && response.result.user_type == 0) {
    //             localStorage.setItem('isLogin', "true");
    //             localStorage.setItem('failedLoginAttempt', 0);
    //             localStorage.setItem('user', JSON.stringify(response.result));
    //             localStorage.setItem('csrftoken', response.result.user_csrftoken);
    //             localStorage.setItem('sessionid', response.result.session_id);
    //             localStorage.setItem('userid', response.result.user_id);
    //             getState();
    //             swal({
    //                 title: 'Access granted',
    //                 text: 'Redirecting in few moments',
    //                 type: 'success',
    //                 confirmButtonText: 'Sure'
    //             })
    //             setTimeout(function () {
    //                 if (localStorage.getItem('isLogin')) {
    //                     window.location.replace("../components/dashboard.html");
    //                 }
    //             }, 2000);
    //         } else {
    //             localStorage.setItem('isLogin', "false");
    //             localStorage.setItem('failedLoginAttempt', localStorage.getItem('failedLoginAttempt') + 1);
    //             swal({
    //                 title: 'Unauthorized access',
    //                 text: 'Dont try again',
    //                 type: 'error',
    //                 confirmButtonText: 'Yup'
    //             })
    //         }

    //     });
    // } else {
    //     console.log("Enter email & password");
    // } l̥
}


function getState() {
    var settings = {
        "url": "../api/api/getstate.php",
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json"
        },
    };

    $.ajax(settings).done(function (response) {
        var data = response;
        localStorage.setItem("state", JSON.stringify(data).toString())
    });
}

function dynamicColors() {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgba(" + r + "," + g + "," + b + ", 0.5)";
}

function poolColors(a) {
    var pool = [];
    for(i = 0; i < a; i++) {
        pool.push(dynamicColors());
    }
    return pool;
}