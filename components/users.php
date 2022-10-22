<?php 

require_once '../includes/database.php';
$data = [];

if ($result = $con->query("SELECT count(*) as `total` FROM `hc_user`;")) {
    $row = $result->fetch_row();
    $data["total_users"] = $row[0];
}

if ($result = $con->query("SELECT count(*) as `total` FROM `hc_user` where `isExpert` = 0;")) {
    $row = $result->fetch_row();
    $data["total_farmers"] = $row[0];
}


if ($result = $con->query("SELECT count(*) as `total` FROM `hc_user` where `isExpert` = 1;")) {
    $row = $result->fetch_row();
    $data["total_experts"] = $row[0];
}

if ($result = $con->query("SELECT count(*) as `total` FROM `hc_user` where `isBanned` = 1;")) {
    $row = $result->fetch_row();
    $data["total_banned"] = $row[0];
}
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Planck Studio">
    <script>
        window.nodeRequire = require;
        delete window.require;
        delete window.exports;
        delete window.module;
    </script>
    <title>Users</title>
    <!-- Favicon -->
    <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/argon.css?v=1.1.0" type="text/css">

    <link rel="stylesheet" href="../assets/vendor/sweetalert2/dist/sweetalert2.min.css" type="text/css">
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script type="module" src="../assets/js/app.js"></script>
    <script src="../assets/vendor/cryptojs/components/core-min.js"></script>
    <script src="../assets/vendor/cryptojs/rollups/md5.js"></script>
    <script src="../assets/js/prettytime.js"></script>
    <script src="../assets/js/render.js"></script>

</head>

<body class="g-sidenav-show g-sidenav-pinned">

    <div class="modal fade" id="userEditDialog" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="true"
        data-backdrop="static">
        <div class="card modal-dialog modal-md bg-secondary border-0 mb-0">
            <div class="card modal-content">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <!-- Avatar -->
                            <a href="#" class="avatar avatar-xl rounded-circle">
                                <img alt="Profile" src="" id="userEditDialogProfile">
                            </a>
                        </div>
                        <div class="col ml--2">
                            <h4 class="mb-0">
                                <a href="#!" id="userEditDialogName">Name</a>
                            </h4>
                            <p class="text-sm text-muted mb-0" id="userEditDialogEmail">Email</p>
                            <span id="userEditDialogStatusClass">●</span>
                            <small id="userEditDialogStatus">Active</small>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header bg-transparent">
                <form>
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="userEditName">Full name</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input class="form-control" id="userEditName" placeholder="Full name" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="userEditEmail">Email address</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input class="form-control" id="userEditEmail" placeholder="Email address"
                                        type="email">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="userEditStatus">User
                                    status</label>
                                <select class="form-control" id="userEditStatus">
                                    <option value="0">Free</option>
                                    <option value="1">Banned</option>
                                    <option value="2">Premium</option>
                                    <option value="3">Tester</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="userEditPoints">Points</label>
                                <div class="input-group in
                                put-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollor"></i></span>
                                    </div>

                                    <input class="form-control" id="userEditPoints" min="0" value="0" max="10000"
                                        type="number">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="userEditNewsletter">
                                    <label class="custom-control-label" for="userEditNewsletter">Enable
                                        Newslatter</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-center col">
                            <button type="button" class="btn btn-primary" id="userEditUpdate">Update</button>
                        </div>

                    </div>

                </form>
            </div>
            <!-- <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                    <small>Change password</small>
                </div>
                <form role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Password" type="password">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Password again"
                                        type="password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary">Change</button>
                        </div>

                </form>
            </div> -->
        </div>
    </div>
    
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scroll-wrapper scrollbar-inner" style="position: relative;">
        <div class="scrollbar-inner scroll-content scroll-scrolly_visible"
            style="height: auto; margin-bottom: 0px; margin-right: 0px; max-height: 591px;">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center"><a class="navbar-brand" href="#"><img
                        src="../assets/img/brand/mark.png" class="navbar-brand-img" alt="..."></a>
                <div class=" ml-auto ">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block active" data-action="sidenav-unpin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner"><i class="sidenav-toggler-line"></i><i
                                class="sidenav-toggler-line"></i><i class="sidenav-toggler-line"></i></div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#navbar-dashboards" data-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="navbar-dashboards"><i
                                    class="material-icons">dashboard</i><span
                                    class="nav-link-text">Dashboards</span></a>
                            <div class="collapse" id="navbar-dashboards">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item"><a href="./dashboard.php#" class="nav-link">Dashboard</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul><!-- Divider -->
                    <hr class="my-3"><!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">Manage</h6><!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item"><a class="nav-link active" href="#navbar-users" data-toggle="collapse"
                                role="button" aria-expanded="true" aria-controls="navbar-users"><i
                                    class="material-icons">person</i><span class="nav-link-text">Users</span></a>
                            <div class="collapse show" id="navbar-users">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item"><a href="./users.php" class="nav-link">User</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul><!-- Divider -->
                </div>
            </div>
        </div>
        <div class="scroll-element scroll-x scroll-scrolly_visible">
            <div class="scroll-element_outer">
                <div class="scroll-element_size"></div>
                <div class="scroll-element_track"></div>
                <div class="scroll-bar" style="width: 0px; left: 0px;"></div>
            </div>
        </div>
        <div class="scroll-element scroll-y scroll-scrolly_visible">
            <div class="scroll-element_outer">
                <div class="scroll-element_size"></div>
                <div class="scroll-element_track"></div>
                <div class="scroll-bar" style="height: 422px; top: 0px;"></div>
            </div>
        </div>
    </div>
    </nav>

    <div class="main-content" id="panel">
    <?php  include './topbar.html' ?> 

        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Users</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                                </ol>
                            </nav>
                        </div>
                    </div> <!-- Card stats -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total users</h5> <span
                                                class="h2 font-weight-bold mb-0 count" id="total-users"><?php echo $data["total_users"]; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                                <i class="material-icons">people</i> </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm"> <span class="text-success mr-2"><i
                                                class="fa fa-arrow-up"></i>&nbsp;<span
                                                id="total-users-per"></span>%</span> <span class="text-nowrap">Since
                                            last month</span> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Farmers</h5> <span
                                                class="h2 font-weight-bold mb-0 count" id="total-new-users"><?php echo $data["total_farmers"]; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                                <i class="material-icons">person</i></div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm"> <span class="text-success mr-2"><i
                                                class="fa fa-arrow-up"></i>&nbsp;<span
                                                id="total-new-per"></span>%</span> <span class="text-nowrap">Since last
                                            month</span> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Expert</h5> <span
                                                class="h2 font-weight-bold mb-0 count" id="total-premium"><?php echo $data["total_experts"]; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="material-icons">star</i></div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm"> <span class="text-nowrap">Lifetime</span> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Banned</h5> <span
                                                class="h2 font-weight-bold mb-0 count" id="total-banned"><?php echo $data["total_banned"]; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                                <i class="material-icons">not_interested</i></div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm"><span class="text-nowrap">Lifetime</span> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="mb-0">Latest Users</h3>
                        </div>
                        <div class="table-responsive active">
                            <table class="table align-items-center table-flush table-striped" id="table-latest-users">
                                <thead class="thead-light">
                                    <tr style="tetx-align: center!important;">
                                        <th scope="col">ID</th>
                                        <th scope="col">Mobile</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Date</th>
                                        <!-- <th scope="col"></th> -->
                                    </tr>
                                </thead>
                                <tbody class="list" id="users-table-latest">

                                </tbody>
                            </table>
                        </div>
                        <!-- Card footer -->
                        <div class="card-footer py-4">
                            <nav aria-label="...">
                                <ul class="pagination justify-content-end mb-0">
                                    <li class="page-item">
                                        <a class="page-link" href="#users-table-latest" onclick="showPage(0)">
                                            <i class="fas fa-angle-left"></i>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#users-table-latest" onclick="showPage(1)">
                                            <i class="fas fa-angle-right"></i>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.1.0"></script>
    <script>


        async function getLatestUser(id) {
            var settings = {
                "url": "http://localhost/asktoagri/dashboard/api/getusers.php?id="+id,
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json"
                }
            };

            return $.ajax(settings).done(function (response) {
                return JSON.parse(response);
            });
        }

        $(document).ready(function () {

            $('#userEditDialog').on('shown.bs.modal', function () {
                $('#userEditName').trigger('focus');
                // $('#userEditDialog').off('keydown.dismiss.bs.modal');
            });

            setData();

            var totalPage = 0;
            var nextUser = 0;

            // if (localStorage.getItem('isLogin') == "false" || localStorage.getItem('isLogin') == null) {
            //     window.location.replace("./login.html");
            // } else {
            //     setData();
            // }
        });

        function showPage(page, ele) {
            var current = $(".visible").first().attr("page");
            var next = current;
            var last = $(".hidden").last().attr("page")

            if (page == 0) {
                next--;
            } else {
                next++;
            }

            if ((totalPage - 1) == $(".visible").last().attr("page")) {
                var p = totalPage;
                var at = `tr`;
                getLatestUser(parseInt($(at).last().attr("uid") - 1), 50).then(res => {
                    var data = res.users;

                    var total = 0;
                    var page = $(".visible").last().attr("page");

                    nextUser = parseInt(data[(data.length - 1)].id);

                    vi = true;

                    for (var i = 0; i < data.length; i++, total++) {

                        if (total > 4) {
                            total = 0;
                            page++;
                            vi = false
                            totalPage = page;
                        }

                        var userTable = {
                            "id": data[i].id,
                            "mobile": data[i].mobile,
                            "type": parseInt(data[i].isExpert),
                            "createdAt": data[i].createdAt,
                            "actionEdit": "renderUserDialogData('" + data[i].id + "');return false;",
                            "statusClass": "",
                            "actionSend": "renderUserDialogData('" + data[i].id + "');return false;",
                            "page": parseInt(page)
                        }
                        renderLatestUserTable(userTable, vi);
                    }

                });

                totalPage = $(".visible").last().attr("page");
            }

            if (next >= 0 && next <= last) {
                $(".visible").each(function () {
                    $(this).removeClass("visible").addClass("hidden");
                });

                $(`[page=${next}]`).each(function () {
                    $(this).removeClass("hidden").addClass("visible");
                });
            }
        }


        function setData() {

            // var data = JSON.parse(localStorage.getItem("state"));

            // var totalPer = (data.users.total - data.users.currentMonth) / 100;
            // var totalNewPer = (data.users.currentMonth - data.users.previousMonth) / 100;
            // var totalNewPerformance = ((data.actions.total / data.actions.previousMonth) * 100);

            // $("#total-users").text(0).attr("data-target", data.users.total);
            // $("#total-users-per").text(totalPer.round(2));
            // $("#total-new-users").text(0).attr("data-target", data.users.currentMonth);
            // $("#total-new-per").text(totalNewPer.round(2));

            // $("#total-premium").text(0).attr("data-target", parseInt(data.users.totalPremium));
            // $("#total-banned").text(0).attr("data-target", parseInt(data.users.totalBanned));

            // counter();

            getLatestUser(0).then(res => {
                    var data = res.users;
                    var total = 0;
                    var page = 0;

                    nextUser = parseInt(data[(data.length - 1)].ID);

                    for (var i = 0; i < data.length; i++, total++) {

                        if (total > 4) {
                            total = 0;
                            page++;
                            totalPage = page;
                        }

                        var userTable = {
                            "id": data[i].id,
                            "mobile": data[i].mobile,
                            "type": parseInt(data[i].isExpert),
                            "createdAt": data[i].createdAt,
                            "actionEdit": "renderUserDialogData('" + data[i].id + "');return false;",
                            "statusClass": "",
                            "actionSend": "renderUserDialogData('" + data[i].id + "');return false;",
                            "page": parseInt(page)
                        }
                        renderLatestUserTable(userTable);
                    }
                });
        }

        function counter() {
            const counters = document.querySelectorAll('.count');
            const speed = 5;

            counters.forEach((counter) => {
                const updateCount = () => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    const count = parseInt(counter.innerText);
                    const increment = Math.trunc(target / speed);

                    if (count < target) {
                        counter.innerText = count + increment;
                        setTimeout(updateCount, 1);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            });
        }

        function renderUserDialogData(id) {
            var settings = {
                "url": "http://localhost/asktoagri/dashboard/api/user.php?id="+id,
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                }
            };

            $.ajax(settings).done(function (response) {
                var data = response.result;
                var statusClass = "text-info";

                $("#userEditStatus").val(parseInt(data.user_status)).change();

                switch (parseInt(data.user_status)) {
                    case 3:
                        data.user_status = "Tester";
                        statusClass = "text-success";
                        break;
                    case 2:
                        data.user_status = "Premium";
                        statusClass = "text-success";
                        break;
                    case 0:
                        data.user_status = "Free";
                        statusClass = "text-info";
                        break;
                    case 1:
                        data.user_status = "Banned";
                        statusClass = "text-default";
                        break;
                    default:
                        data.user_status = "text-info";
                        break;
                }

                $("#userEditDialogName").text("Name");
                $("#userEditDialogEmail").text("Email");
                $("#userEditDialogStatus").text("Status");
                $("#userEditDialogStatusClass").attr("class", "text-info");
                $("#userEditUpdate").attr("uid", id);
                $("#userEditDialogProfile").attr("src", "");
                $("#userEditName").val("");
                $("#userEditEmail").val("");

                $("#userEditDialogName").text(data.user_first_name);
                $("#userEditDialogEmail").text(data.user_email);
                $("#userEditDialogStatus").text(data.user_status);
                $("#userEditPoints").val(data.user_points);
                $("#userEditDialogStatusClass").attr("class", statusClass);
                $("#userEditDialogProfile").attr("src", getGravatarImage(data.user_email));

                $("#userEditName").val(data.user_first_name);
                $("#userEditEmail").val(data.user_email);

                if (parseInt(data.user_newsletter)) {
                    $("#userEditNewsletter").prop('checked', true);
                }
                else {
                    $("#userEditNewsletter").prop('checked', false);
                }
            });
        }
    </script>
</body>

</html>