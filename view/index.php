<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- <meta name="description" content="" />
        <meta name="author" content="" /> -->
        <title>首頁</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../static/css/styles.css" rel="stylesheet" />
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../static/js/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" crossorigin="anonymous"></script>
        <!-- <script src="/static/assets/demo/chart-current-performance-demo.js"></script> -->
        <!-- <script src="/static/assets/demo/chart-forecast-demand.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <!-- <script src="/static/js/datatables-simple-demo.js"></script> -->
    </head>
    <body class="bg-img">
        <!-- <img border='0' src='../assets/img/index.jpg' width='100%' height='100%' style='position: absolute;left:0px;top:0px;z-index: -1'> -->
        <img src="../static/assets/img/index.jpg" width='100%' height='100%' style='position: absolute;left:0px;top:0px;z-index: -1'>
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
                        <li><hr class="dropdown-divider" /></li>
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
                            <!-- <div class="sb-sidenav-menu-heading">菜單</div>
                            <a class="nav-link" href=""{% url 'index' %}>
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                首頁
                            </a> -->
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
                        </div>
                    </div>
                </main>
    </body>
</html>
