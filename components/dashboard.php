<?php

require_once '../includes/database.php';
setcookie("base_url", $_SERVER["BASE_URL"], time() + (86400 * 30), "/");

$data = [];

if ($result = $con->query("SELECT count(*) as `total` FROM `hc_user`;")) {
    $row = $result->fetch_row();
    $data["total_users"] = $row[0];
}

if ($result = $con->query("SELECT count(*) as `total` FROM `hc_query` where `spam` = 0;")) {
    $row = $result->fetch_row();
    $data["total_query"] = $row[0];
}

if ($result = $con->query("SELECT count(*) as `total` FROM `hc_query` where `resolved` = 0;")) {
    $row = $result->fetch_row();
    $data["total_query_pending"] = $row[0];
}

if ($result = $con->query("SELECT count(*) as `total` FROM `hc_solution`;")) {
    $row = $result->fetch_row();
    $data["total_solution"] = $row[0];
}

?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <!-- <script>
        window.nodeRequire = require;
        delete window.require;
        delete window.exports;
        delete window.module;
    </script> -->
    <title>Dashboard - Ask to Agri Expert</title>
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
    <script src="../assets/js/app.js"></script>
    <script src="../assets/vendor/cryptojs/components/core-min.js"></script>
    <script src="../assets/vendor/cryptojs/rollups/md5.js"></script>
    <script src="../assets/js/render.js"></script>

</head>

<body class="g-sidenav-show g-sidenav-pinned">

    <?php  include './sidebar.html' ?> 

    <div class="main-content" id="panel">
        <!-- <script>document.write(renderTopbar());</script> -->

        <?php  include './topbar.html' ?> 

        <!-- Dashboard Header Start -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Default</li>
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
                                                class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                                <i class="material-icons">people</i>
                                            </div>
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
                                            <h5 class="card-title text-uppercase text-muted mb-0">Total Query</h5> <span
                                                class="h2 font-weight-bold mb-0 count" id="total-new-users"><?php echo $data["total_query"]; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                                <i class="material-icons">person</i>
                                            </div>
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
                                            <h5 class="card-title text-uppercase text-muted mb-0">Pending Query</h5> <span
                                                class="h2 font-weight-bold mb-0 count" id="total-created"><?php echo $data["total_query_pending"]; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                                <i class="material-icons">edit</i>
                                            </div>
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
                                            <h5 class="card-title text-uppercase text-muted mb-0">Solution</h5> <span
                                                class="h2 font-weight-bold mb-0 count" id="total-actions"><?php echo $data["total_solution"]; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div
                                                class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                                <i class="material-icons">trending_up</i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-sm"> <span class="text-nowrap">Lifetime</span> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Dashboard Header End -->

        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-8">

                    <div class="card bg-default">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-light text-uppercase ls-1 mb-1">Overview - Current year</h6>
                                    <h5 class="h3 text-white mb-0">Users</h5>
                                </div>
                                <!-- <div class="col">
                                    <ul class="nav nav-pills justify-content-end">
                                        <li class="nav-item" data-toggle="chart" id="chart-user-all"
                                            data-target="#chart-user-dark">
                                            <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                                <span class="d-none d-md-block">All</span>
                                                <span class="d-md-none">T</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" data-toggle="chart" id="chart-user-farmer"
                                            data-target="#chart-user-dark">
                                            <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                                <span class="d-none d-md-block">Farmer</span>
                                                <span class="d-md-none">P</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" data-toggle="chart" id="chart-user-expert"
                                            data-target="#chart-user-dark">
                                            <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                                <span class="d-none d-md-block">Expert</span>
                                                <span class="d-md-none">P</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Chart -->
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <!-- Chart wrapper -->
                                <canvas id="chart-user-dark" class="chart-canvas  chartjs-render-monitor" width="778"
                                    height="350" style="display: block; width: 778px; height: 350px;"></canvas>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-4">

                    <div class="card bg-default">
                        <div class="card-header bg-transparent">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                                    <h5 class="h3 text-white mb-0">Query</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Chart -->
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <!-- Chart wrapper -->
                                <canvas id="chart-query-dark" class="chart-canvas  chartjs-render-monitor" width="778"
                                    height="350" style="display: block; width: 778px; height: 350px;"></canvas>
                            </div>
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
        $(document).ready(function () {

            getState("<?php echo $_SERVER['BASE_URL'];?>");
            // setData();

            var data = JSON.parse(localStorage.getItem("state"));

            changeUserChart(data.state.users, 'All');
            changeQueryChart(data.state.query, 'All');

            $("#chart-user-all").on('click', function (e) {
                changeUserChart(data.state.users.all);
            });

            $("#chart-user-farmer").on('click', function (e) {
                // changeUserChart(data.state.users.farmer);
                var ctx = document.getElementById('chart-user-dark').getContext('2d');
                var chart = new Chart(ctx, options);
                chart.getDatasetMeta(1).hidden=true;
                chart.update();
            });

            $("#chart-user-expert").on('click', function (e) {
                changeUserChart(data.state.users.expert);
            });

            // if (localStorage.getItem('isLogin') == "false" || localStorage.getItem('isLogin') == null) {
            //     window.location.replace("./login.html");
            // } else {
            //     // getState();
                
            //     //setInterval(setData(), 60 * 1000);
            //     var allUserChartData = [];
            // }
        });


        function changeUserChart(data) {

            // $('#chart-user-dark').clear();

            var UserChart = (function () {
                const ctx = document.getElementById('chart-user-dark').getContext('2d');

                var userChart = new Chart(ctx, {
                    type: 'line',
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    color: Charts.colors.gray[700],
                                    zeroLineColor: Charts.colors.gray[700]
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    },
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [
                            {
                                label: "Farmers",
                                data: renderUserChart(data.farmer),
                                order: 1,
                                backgroundColor: [
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)',
                                    'rgb(107,254,98,0.2)'
                                ],
                                borderColor: [
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)',
                                    'rgb(107,254,98,1)'
                                ],
                            },
                            {
                                label: "Experts",
                                data: renderUserChart(data.expert),
                                order: 1,
                                backgroundColor: [
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)',
                                    'rgb(107,98,254,0.2)'
                                ],
                                borderColor: [
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)',
                                    'rgb(107,98,254,1)'
                                ],
                            }
                        ]
                    }
                });
            })();
        }


        function changeQueryChart(data) {

        var UserChart = (function () {
            const ctx = document.getElementById('chart-query-dark').getContext('2d');

            var dummyData = [  
                    {
                        "Pending": 1
                    }
                ]

            var crops = [];
            var total= [];

            for(var i=0;i<data.all.crops.length;i++) {
                crops[i] = data.all.crops[i].crops;
                total[i] = data.all.crops[i].total;
            }

            console.log(crops);


            var userChart = new Chart(ctx, {
                type: 'pie',
                options: {
                    scales: {
                        yAxes: [{
                            gridLines: {
                                color: Charts.colors.gray[700],
                                zeroLineColor: Charts.colors.gray[700]
                            },
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                },
                data: {
                    labels: crops,
                    datasets: [
                        {
                            label: "Crops",
                            data:total,
                            order: 1,
                            backgroundColor: poolColors(crops.length)
                        }
                    ]
                }
            });
        })();
        }


        function setData() {

            // renderUserChartData(data.users.all.months, "#chart-user-all");
            // renderUserChartData(data.users.premium.months, "#chart-user-premium");
            // renderUserChartData(data.users.free.months, "#chart-user-free");
            // renderUserChartData(data.users.baned.months, "#chart-user-baned");

            var UserChart = (function () {

                // Variables
                //var $chart = $('#chart-user-dark');
                const ctx = document.getElementById('chart-user-dark').getContext('2d');
                // Methods


                var dummyData = [  
                    {
                        "monthName": "January",
                        "total": 50
                    }
                ]

                var data = JSON.parse(localStorage.getItem("state"));
                
                var userChart = new Chart(ctx, {
                    type: 'line',
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    color: Charts.colors.gray[700],
                                    zeroLineColor: Charts.colors.gray[700]
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    },
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [
                            {
                                label: 'All',
                                data: renderUserChart(data.state.query.all.time),
                                order: 1,
                            }
                        ]
                    }
                });
            })();
        }

        function renderQueryChart(data) {
            var items = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            for (var i = 0; i < data.length; i++) {
                var j = getMonthNumber(data[i].monthName);
                items[j] = parseInt(data[i].total);
            }

            return items;
        }

        function renderUserChart(data) {
            var items = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            for (var i = 0; i < data.length; i++) {
                var j = getMonthNumber(data[i].monthName);
                items[j] = parseInt(data[i].total);
            }

            return items;
        }

        function renderUserChartData(data, ele) {
            var items = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

            for (var i = 0; i < data.length; i++) {
                var j = getMonthNumber(data[i].monthName);
                items[j] = parseInt(data[i].total);
            }

            return items;

            var d = {
                "data": {
                    "datasets": [
                        {
                            "data": items
                        }
                    ]
                }
            };

            var js = JSON.stringify(d);

            $(ele).attr("data-update", js.replace(/"/g, "&quot;"));
        }

        function counter() {
            const counters = document.querySelectorAll('.count');
            const speed = 50;

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

        function getMonthNumber(month) {
            var r = -1;
            var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            for (var i = 0; i < months.length; i++) {
                if (month == months[i]) {
                    r = i;
                    break;
                }
            }

            return r;
        }
    </script>
</body>

</html>