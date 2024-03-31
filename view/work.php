<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>作業管理</title>
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
        <a class="navbar-brand ps-3" href="index.php">台畜行銷系統</a>
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
                    <h1 class="mt-4">作業管理</h1>
                    <p align="right">
                        <select name="product_name" id="product_name">
                            <option>請選擇產品</option>
                        </select>
                        <button id="search">搜尋</button>
                    </p>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    庫存與預測需求
                                </div>
                                <div class="card-body"><canvas id="demand" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    實際需求與預測需求
                                </div>
                                <div class="card-body"><canvas id="forecast" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            產品庫存
                            <a href="add_product.php"><button type="button" class="btn btn-warning">加入產品</button></a>

                        </div>
                        <div class="card-body">
                            <table id="product_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>產品名稱</th>
                                        <th>價格</th>
                                        <th>成本</th>
                                        <th>庫存</th>
                                        <th>準備時間(日)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </main>
    </div>
</body>

</html>
<script>
    sel_product_name();
    // sel_work_data();
    // $(document).ready(function() {
    //     sel_work_data();
    // })
    $("#search").click(function() {
        // $("#demand").empty();
        // chart.clear();
        sel_work_data();
       
    })

    function sel_product_data_controller() {
        $.ajax({
            url: '../controller/table_controller.php',
            data: {
                'OpType': 'sel_product_data_controller',
            },
            dataType: "text",
            type: 'POST'
        }).done(function(res) {
            // console.log(res);
            var obj = JSON.parse(res);
            // console.log(obj);
            data_mat_table("#product_table", obj, {
                deferRender: true,
                scrollCollapse: true,
                scroller: false,
                info: true,
                ordering: false,
                etrieve: true,
                paging: true,
                destroy: true,
                bLengthChange: true,
                searching: true
            }, [], [{
                    "data": "name"
                },
                {
                    "data": "price"
                },
                {
                    "data": "product_cost"
                },
                {
                    "data": "stock"
                },
                {
                    "data": "prepare_day"
                },
            ]);
        }).fail(function(error) {
            console.log(error);
        });
    }
    sel_product_data_controller()

    async function sel_product_name() {
        var data = {
            OpType: 'sel_product_name_controller'
        };
        await $.ajax({
            url: '../controller/add_controller.php',
            data: data,
            dataType: 'text',
            type: 'POST',
        }).done(function(res) {
            // console.log(res);
            var str = JSON.parse(res);
            // console.log(str[0].P_Name);
            var l = str.length;
            for (var i = 0; i < l; i++) {
                $("#product_name").append("<option value=" + str[i].P_Name + ">" + str[i].P_Name + "</option>");
            };
        }).fail(function(error) {
            console.log(error);
        });
    };

    function sel_work_data() {
        var product_name = $('select[name="product_name"]').val();
        console.log(product_name);
        $.ajax({
            url: '../controller/work_controller.php',
            data: {
                product_name: product_name,
                'OpType': 'sel_work_data_controller',
            },
            dataType: "text",
            type: 'POST'
        }).done(function(res) {
            // console.log(res);
            var obj = JSON.parse(res);
            console.log(obj);

            ctx = document.getElementById("forecast");
            ctx1 = document.getElementById("demand");

            var chart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: [product_name],
                    datasets: [{
                            type: "bar",
                            label: "實際需求",
                            backgroundColor: "rgba(54, 162, 235, 0.2)",
                            borderColor: "rgba(54, 178, 235, 1)",
                            data: [obj[1]],
                            lineTension: 1, // 曲線的彎度，設 0 表示直線
                            fill: false // 是否填滿色彩
                        },
                        {
                            type: "bar",
                            label: "預測需求",
                            borderColor: "rgba(92, 258, 235, 1)",
                            data: [obj[0]],
                            lineTension: 0, // 曲線的彎度，設 0 表示直線
                            fill: false // 是否填滿色彩
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
                                max: 500,
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
                },
                // animation: { // 这部分是数值显示的功能实现
                //     onComplete: function() {
                //         var ctx = this.chart.ctx;
                //         ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                //         ctx.fillStyle = "black";
                //         ctx.textAlign = 'center';
                //         ctx.textBaseline = 'bottom';

                //         this.data.datasets.forEach(function(dataset) {
                //             for (var i = 0; i < dataset.data.length; i++) {
                //                 for (var key in dataset._meta) {
                //                     var model = dataset._meta[key].data[i]._model;
                //                     ctx.fillText(dataset.data[i], model.x, model.y - 5);
                //                 }
                //             }
                //         });
                //     }
                // }
            });
            var chart = new Chart(ctx1, {
                type: "bar",
                data: {
                    labels: [product_name],
                    datasets: [{
                            type: "bar",
                            label: "庫存",
                            backgroundColor: "rgba(54, 162, 235, 0.2)",
                            borderColor: "rgba(54, 178, 235, 1)",
                            data: [obj[2]],
                            lineTension: 1, // 曲線的彎度，設 0 表示直線
                            fill: false // 是否填滿色彩
                        },
                        {
                            type: "bar",
                            label: "預測需求",
                            borderColor: "rgba(92, 258, 235, 1)",
                            data: [obj[0]],
                            lineTension: 0, // 曲線的彎度，設 0 表示直線
                            fill: false // 是否填滿色彩
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
                                max: 500,
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
                },
            });
        });
    }
</script>