<?php 

require_once '../includes/database.php';
setcookie("base_url", $_SERVER["BASE_URL"], time() + (86400 * 30), "/");
$data = [];

if ($result = $con->query("SELECT count(*) as `total` FROM `hc_category`;")) {
    $row = $result->fetch_row();
    $data["total_category"] = $row[0];
}

?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="PlanckStudio">
    <script>
        window.nodeRequire = require;
        delete window.require;
        delete window.exports;
        delete window.module;
    </script>
    <title>Category</title>
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
    <script src="../assets/vendor/js-cookie/js.cookie.js"></script>

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
                        <li class="nav-item"><a class="nav-link" href="#navbar-users" data-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="navbar-users"><i
                                    class="material-icons">person</i><span class="nav-link-text">Users</span></a>
                            <div class="collapse" id="navbar-users">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item"><a href="./users.php" class="nav-link">User</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link active" href="#navbar-category" data-toggle="collapse"
                                role="button" aria-expanded="true" aria-controls="navbar-category"><i
                                    class="material-icons">category</i><span class="nav-link-text">Category</span></a>
                            <div class="collapse show" id="navbar-category">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item"><a href="./category.php" class="nav-link">Category</a></li>
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
                            <h6 class="h2 text-white d-inline-block mb-0">Category</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Category</li>
                                </ol>
                            </nav>
                        </div>
                    </div> <!-- Card stats -->
                    <div class="row">
                        <div class="col-xl-6 col-md-12">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Add Category</h5>
                                    <div class="input-group mb-3 mt-2">
                                        <input type="text" id="category-input" class="form-control" placeholder="Category name" aria-label="Category name" aria-describedby="button-add-category">
                                        <button class="btn btn-outline-primary mb-0" type="button" id="button-add-category">ADD</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total category</h5> <span
                                                class="h2 font-weight-bold mb-0 count" id="total-users"><?php echo $data["total_category"]; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                                <i class="material-icons">category</i> </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm"> <span class="text-success mr-2">Lifetime</span> </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Trending</h5><span
                                                class="h2 font-weight-bold mb-0" id="trending-category"></span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                                <i class="material-icons">trending_up</i></div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm"> <span class="text-success mr-2">Lifetime</p>
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
                            <h3 class="mb-0">All Category</h3>
                        </div>
                        <div class="table-responsive active">
                            <table class="table align-items-center table-flush table-striped" id="table-latest-users">
                                <thead class="thead-light">
                                    <tr style="tetx-align: center!important;">
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Total Query</th>
                                        <th scope="col">Total Solution</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list" id="category-table">

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

        async function addCategory(name) {

            var base = "<?php ?>"

            var settings = {
                "url": "<?php echo $_SERVER['API_URL'];?>",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json"
                },
                "data": JSON.stringify({
                    "request": "add",
                    "type": "category",
                    "filter": "",
                    "param": {
                    "name": name
                    }
                }),
            };

            $.ajax(settings).done(function (response) {
                if(response.code == 200) {
                    swal({
                        title: name,
                        text: 'New Category Added',
                        type: 'success',
                        confirmButtonText: 'Sure'
                    })

                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);

                }
            });
        }

        $(document).ready(function () {

            var data = JSON.parse(localStorage.getItem("state"));
            category = data.state.query.all.category;
            console.log(data.state.query.all.category);

            let max = category[0].total;
            let min = category[0].total;
            let trendingCategory = category[0].category;
            let leastCategory = category[0].category;
            for (let i = 1; i < category.length; ++i) {
                if (category[i].total > max) {
                    max = category[i].total;
                    trendingCategory = category[i].category;
                }

                if (category[i].total < min) {
                    min = category[i].total;
                    leastCategory = category[i].category;
                }
            }

            $("#trending-category").text(trendingCategory);
            $("#least-category").text(leastCategory);

            $('#button-add-category').on('click', function (e) {
                var cat = $("#category-input").val();
                if(cat != null || cat != "") {
                    addCategory(cat);
                }
            });
            
            setData();

        });

        async function getCategory(id) {
            var settings = {
                "url": decodeURI(Cookies.get("base_url")) + "api/getcategory.php?id="+id,
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

    </script>
</body>

</html>