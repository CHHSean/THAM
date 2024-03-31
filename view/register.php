<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- <meta name="description" content="" />
        <meta name="author" content="" /> -->
    <title>Register - SB Admin</title>
    <link href="../static/css/styles.css" rel="stylesheet" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../static/js/jquery-3.5.1.min.js"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">註冊</h3>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="user_id" placeholder="user_id" />
                                            <label for="user_id">帳號</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputUsername" placeholder="name" />
                                            <label for="inputUsername">姓名</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <div class="form-floating mb-3 mb-md-0">
                                                <input class="form-control" id="admintype" placeholder="admintype" />
                                                <label for="admintype">員工編碼</label>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input type="password" class="form-control" id="inputPassword" placeholder="Create a password" />
                                                    <label for="inputPassword">密碼</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input type="password" class="form-control" id="chk_password" placeholder="chk" />
                                                    <label for="chk_password">再次確認</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><a class="btn btn-primary btn-block" id="register">註冊</a></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">已有帳號? 登入</a></div>
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
    $("#register").click(function() {
        var account = $('#user_id').val();
        var username = $('#inputUsername').val();
        var admintype = $('#admintype').val();
        var password = $('#inputPassword').val();
        var chkpsd = $('#chk_password').val();
        data = {
                account: account,
                username: username,
                admintype: admintype,
                password: password,
                OpType: 'register_login_controller'
            };
        if (password != chkpsd) {
            alert('密碼不相同')
        } else if(account == ''){
            alert('帳號尚未填寫')
        } else if(username == ''){
            alert('姓名尚未填寫')
        } else if(admintype == ''){
            alert('員編尚未填寫')
        } else if(password == ''){
            alert('密碼尚未填寫')
        } else{
            register(data);
        }
    })

    async function register(data) {
        await $.ajax({
            url: '../controller/login_controller.php',
            data: data,
            dataType: "text",
            type: 'POST'
        }).done(function(res) {
            // console.log(res)
            var str = JSON.parse(res);
            // console.log(str);
            if (str.status == '200') {
               alert('成功註冊')
                window.location.href = "login.php";
            } else {
                alert('帳號已註冊過，請重新嘗試')
            };
        }).fail(function(error) {
            // console.log(error.status);
        })
    };
</script>