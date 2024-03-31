<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- <meta name="description" content="" />
        <meta name="author" content="" /> -->
    <title>選擇客戶</title>
    <link href="../static/css/styles.css" rel="stylesheet" />
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../static/js/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">訂單</h3>
                                </div>
                                <div class="card-body">
                                    <label for="customername">請輸入顧客名稱</label>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="customername">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <p align="center">
                                            <button class="btn btn-primary" id="cancel_btn">取消</button>
                                            <button class="btn btn-primary" id="add_btn">確認</button>
                                        </p>
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
    $("#cancel_btn").click(function() {
        var cancel = confirm('確定取消?');
        if (cancel) {
            history.go(-1);
        }
    })
    $("#add_btn").click(function() {
        var customername = $('#customername').val();
        var data = {
            customername: customername,
            OpType: "add_customer_controller"
        };
        if (customername == '') {
            alert('顧客名稱尚未填寫')
        } else {
            var sure = confirm('確定顧客名稱?');
            if (sure) {
                add_data(data);
            }
        }
    })

    async function add_data(data) {
        await $.ajax({
            url: '../controller/add_controller.php',
            data: data,
            dataType: 'text',
            type: 'POST',
        }).done(function(res) {
            console.log(res);
            var obj = JSON.parse(res);
            console.log(obj);
            if (obj.status == '200') {
                alert('成功')
                localStorage.name = document.getElementById("customername").value;
                location.href = "form_order.php"
                // localStorage.name = document.getElementById("customername").value;
            };
        }).fail(function(error) {
            console.log(error);
        });
    }
</script>