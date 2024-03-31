<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>數據表</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="../static/js/jquery-3.5.1.min.js"></script>
    <link href="../static/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../static/datatables/js/jquery.dataTables.min.js"></script>

    <link href="../static/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="../static/datatables/datatable_module.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->
    <!-- <script src="/static/js/datatables-simple-demo.js"></script>
        <script src="/static/js/database_activity.js"></script> -->
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="{% url 'index' %}">台畜行銷系統</a>
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
                    <h1 class="mt-4">數據表</h1>
                    <ol class="breadcrumb mb-4">
                    </ol>

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
                                        <th>成本</th>
                                        <th>價格</th>
                                        <th>庫存</th>
                                        <th>準備時間(日)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            訂單
                            <a href="enter_customer.php"><button type="button" class="btn btn-warning">新增訂單</button></a>
                        </div>
                        <div class="card-body">
                            <table id="order_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>顧客名稱</th>
                                        <th>電話</th>
                                        <th>電郵地址</th>
                                        <th>產品名稱</th>
                                        <th>購買數量</th>
                                        <th>總價格</th>
                                        <th>備駐</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            原料庫存
                            <a href="form_material.php"><button type="button" class="btn btn-warning">新增原料</button></a>

                        </div>
                        <div class="card-body">
                            <table id="material_table" style = "width: 100%;">
                                <thead>
                                    <tr>
                                        <th>原料名稱</th>
                                        <th>成本</th>
                                        <th>庫存</th>
                                        <th>準備時間</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            活動
                            <a href="form_activity.php"><button type="button" class="btn btn-warning">新增活動</button></a>

                        </div>
                        <div class="card-body">
                            <table id="activity_table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>開始時間</th>
                                        <th>結束時間</th>
                                        <th>活動名稱</th>
                                        <th>成本</th>
                                        <th>目標客群</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </main>
</body>

</html>
<script>
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
            console.log(obj);
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

    function sel_material_data_controller() {
        $.ajax({
            url: '../controller/table_controller.php',
            data: {
                'OpType': 'sel_material_data_controller',
            },
            dataType: "text",
            type: 'POST'
        }).done(function(res) {
            // console.log(res);
            var obj = JSON.parse(res);
            console.log(obj);
            data_mat_table("#material_table", obj, {
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
                    "data": "cost"
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
    sel_material_data_controller();

    function sel_activity_data() {
        $.ajax({
            url: '../controller/table_controller.php',
            data: {
                'OpType': 'sel_activity_data',
            },
            dataType: "text",
            type: 'POST'
        }).done(function(res) {
            // console.log(res);
            var obj = JSON.parse(res);
            console.log(obj);
            data_mat_table("#activity_table", obj, {
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
                    "data": "start_date"
                },
                {
                    "data": "end_date"
                },
                {
                    "data": "name"
                },
                {
                    "data": "cost"
                },
                {
                    "data": "target"
                },
            ]);
        }).fail(function(error) {
            console.log(error);
        });
    }
    sel_activity_data();

    function sel_order_data() {
        $.ajax({
            url: '../controller/table_controller.php',
            data: {
                'OpType': 'sel_order_data',
            },
            dataType: "text",
            type: 'POST'
        }).done(function(res) {
            // console.log(res);
            var obj = JSON.parse(res);
            console.log(obj);
            data_mat_table("#order_table", obj, {
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
                    "data": "c_name"
                },
                {
                    "data": "phone"
                },
                {
                    "data": "mail"
                },
                {
                    "data": "p_name"
                },
                {
                    "data": "amount"
                },
                {
                    "data": "price"
                },
                {
                    "data": "status"
                },
            ]);
        }).fail(function(error) {
            console.log(error);
        });
    }
    sel_order_data();
</script>