<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- <meta name="description" content="" />
        <meta name="author" content="" /> -->
    <title>登入</title>
    <link href="../static/css/styles.css" rel="stylesheet" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../static/js/jquery-3.5.1.min.js"></script>
</head>

<body class="bg-primary">
    <img src="../static/assets/img/log.jpg" width='100%' height='100%' style='position: absolute;left:0px;top:0px;z-index: -1'>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">登入</h3>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" placeholder="name@example.com" />
                                            <label for="inputEmail">帳號</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="inputPassword" placeholder="Password" />
                                            <label for="inputPassword">密碼</label>
                                        </div>
                                        <!-- <div class="d-flex align-items-center justify-content-between mt-4 mb-0"> -->
                                        <!-- <a class="small" href="password.php">忘記密碼?</a> -->
                                        <p align="center">
                                            <a class="btn btn-primary" id="login">登入</a>
                                        </p>
                                        <!-- </div> -->
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">註冊</a></div>
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
    //登入
    $("#login").click(function() {
        var account = $('#inputEmail').val();
        var psd = $('#inputPassword').val();
        data = {
            account: account,
            psd: psd,
            OpType: 'login_login_controller'
        };
        // console.log(data);
        if (account == '' || psd == '') {
            alert('請輸入帳號和密碼')
        } else {
            uphold(data);
        };
    })


    function uphold(data) {
        $.ajax({
            url: '../controller/login_controller.php',
            data: data,
            dataType: 'json',
            type: 'POST',
        }).done(function(res) {
            if (res.status == '200') {
                alert('成功登入')
                window.location.href = "index.php";
            } else {
                alert('帳號或密碼錯誤')
            }

        }).fail(function(error) {
            console.log(error);
        });
    };
</script>