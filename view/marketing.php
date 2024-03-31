<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>行銷管理</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="../static/js/jquery-3.5.1.min.js"></script>
    <link href="../static/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../static/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../static/js/chart.js"></script>
    <link href="../static/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="../static/datatables/datatable_module.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->
    <!-- <script src="/static/js/datatables-simple-demo.js"></script>
        <script src="/static/js/database_activity.js"></script> -->
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3">台畜行銷系統</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">設定</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="login.php">登出</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">菜單</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            首頁
                        </a>
                        <div class="sb-sidenav-menu-heading">功能</div>
                        <a class="nav-link" href="marketing.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            行銷管理
                        </a>
                        <a class="nav-link" href="work.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            作業管理
                        </a>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            數據表
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">行銷管理</h1>
                    </ol>
                    <p align="right">
                        <select name="activity_name" id="activity_name">
                            <option>請選擇活動</option>
                        </select>
                        <button id="search">搜尋</button>
                    </p>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    獲取率
                                </div>
                                <div class="card-body"><canvas id="getrate" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    取得成本與收益
                                </div>
                                <div class="card-body"><canvas id="getChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    本期與上年同期留存率
                                </div>
                                <div class="card-body"><canvas id="Retention" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    本期與上年同期流失率
                                </div>
                                <div class="card-body"><canvas id="churn" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </main>

    </div>
    </div>
</body>

</html>
<script>
    sel_act_name();
    $("#search").click(function() {
        // $("#demand").empty();
        // chart.clear();
        sel_marketing_data();

    })

    async function sel_act_name() {
        var data = {
            OpType: 'sel_act_name_controller'
        };
        await $.ajax({
            url: '../controller/marketing_controller.php',
            data: data,
            dataType: 'text',
            type: 'POST',
        }).done(function(res) {
            // console.log(res);
            var str = JSON.parse(res);
            // console.log(str);
            console.log(str[0].A_name);
            var l = str.length;
            for (var i = 0; i < l; i++) {
                $("#activity_name").append("<option value=" + str[i].A_name + ">" + str[i].A_name + "</option>");
            };
        }).fail(function(error) {
            console.log(error);
        });
    };

    function sel_marketing_data() {
        var activity_name = $('select[name="activity_name"]').val();
        // console.log(product_name);
        $.ajax({
            url: '../controller/marketing_controller.php',
            data: {
                activity_name: activity_name,
                'OpType': 'sel_marketing_data_controller',
            },
            dataType: "text",
            type: 'POST'
        }).done(function(res) {
            // console.log(res);
            var obj = JSON.parse(res);
            console.log(obj);
            var ctx = document.getElementById("getrate");
            var chart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: [activity_name],
                    datasets: [{
                        type: "bar",
                        label: "目標客群",
                        backgroundColor: "rgba(54, 162, 235, 0.2)",
                        borderColor: "rgba(54, 178, 235, 1)",
                        data: [obj[0]],
                        lineTension: 1, // 曲線的彎度，設 0 表示直線
                        fill: false // 是否填滿色彩
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 100,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    },
                    legend: {
                        display: false
                    }
                }
            });
            var ctx1 = document.getElementById("getChart");
            var chart = new Chart(ctx1, {
                type: "bar",
                data: {
                    labels: [],
                    datasets: [{
                            type: "bar",
                            backgroundColor: "rgba(54, 162, 235, 0.2)",
                            borderColor: "rgba(54, 162, 235, 1)",
                            borderWidth: 1,
                            label: "取得成本",
                            data: [obj[1]],
                            lineTension: 0, // 曲線的彎度，設 0 表示直線
                            //fill: true // 是否填滿色彩
                        },
                        {
                            type: "bar",
                            backgroundColor: "rgba(54, 258, 235, 0.2)",
                            label: "預期目標",
                            data: [obj[2]],
                            lineTension: 0, // 曲線的彎度，設 0 表示直線
                            //fill: true // 是否填滿色彩
                        },
                        {
                            type: "bar",
                            backgroundColor: "rgba(102, 243, 146, 0.2)",
                            label: "實際結果",
                            data: [obj[3]],
                            lineTension: 0, // 曲線的彎度，設 0 表示直線
                            //fill: true // 是否填滿色彩
                        }
                    ]
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 1000000,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    },
                    legend: {
                        display: true
                    }
                }
            });
            var ctx2 = document.getElementById("Retention");
            var chart = new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: [],
                    datasets: [{
                            type: "bar",
                            label: "本期留存率",
                            backgroundColor: "rgba(54, 162, 235, 0.2)",
                            borderColor: "rgba(54, 162, 235, 1)",
                            data: [obj[4]],
                            lineTension: 0, // 曲線的彎度，設 0 表示直線
                            fill: true // 是否填滿色彩
                        },
                        {
                            type: "bar",
                            label: "上年同期留存率",
                            borderColor: "rgba(72, 258, 235, 1)",
                            data: [obj[5]],
                            lineTension: 0, // 曲線的彎度，設 0 表示直線
                            fill: true // 是否填滿色彩
                        }
                    ]
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 100,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    },
                    legend: {
                        display: true
                    }
                }
            });
            var ctx3 = document.getElementById("churn");
            var chart = new Chart(ctx3, {
                type: "bar",
                data: {
                    labels: [],
                    datasets: [{
                            type: "bar",
                            label: "本期流失率",
                            backgroundColor: "rgba(54, 162, 235, 0.2)",
                            borderColor: "rgba(54, 162, 235, 1)",
                            data: [obj[6]],
                            lineTension: 0, // 曲線的彎度，設 0 表示直線
                            fill: true // 是否填滿色彩
                        },
                        {
                            type: "bar",
                            label: "上年同期流失率",
                            borderColor: "rgba(72, 258, 235, 1)",
                            data: [obj[7]],
                            lineTension: 0, // 曲線的彎度，設 0 表示直線
                            fill: true // 是否填滿色彩
                        }
                    ]
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'date'
                            },
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 100,
                                maxTicksLimit: 5
                            },
                            gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                    },
                    legend: {
                        display: true
                    }
                }
            });
        });
    }
</script>