<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- <meta name="description" content="" />
        <meta name="author" content="" /> -->
    <title></title>
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
                                    <label for="productname">請選擇產品</label>
                                    <div class="form-floating mb-3">
                                        <select class="form-control" name="product_name" id = "product_name" placeholder="請選擇產品">
                                            <option></option>
                                        </select>
                                    </div>
                                    <label for="unit">數量</label>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="unit">
                                    </div>
                                    <label for="COMMENT">備註</label>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="comment">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <p align="center">
                                            <button class="btn btn-primary" id="cancel_btn">取消</button>
                                            <button class="btn btn-primary" id="tmp_btn">暫存</button>
                                            <button class="btn btn-primary" id="payed_btn">已付款</button>
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
    $(document).ready(function() {
        sel_product_name();
    })

    $("#cancel_btn").click(function() {
        var cancel = confirm('確定取消?');
        if (cancel) {
            window.location.href = "tables.php"
        }
    })

    //暫存
    $("#tmp_btn").click(function() {
        var customer_name = localStorage["name"];
        // console.log("---------------");
        // console.log(customer_name);
        var product_name = $('select[name="product_name"]').val();
        // console.log(product_name);
        var unit = $('#unit').val();
        var comment = $('#comment').val();
        var data = {
            customer_name: customer_name,
            product_name: product_name,
            unit: unit,
            comment: comment,
            OpType: "tmp_order_controller"
        };
        if (product_name == '') {
            alert('請輸入產品名稱')
        } else if (unit == '') {
            alert('請輸入購買數量')
        } else {
            var sure = confirm('確定新增?');
            if (sure) {
                tmp_data(data);
            }
        }
    })

    async function tmp_data(data) {
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
                window.location.href = "tables.php"
            };
        }).fail(function(error) {
            console.log(error);
        });
    }

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

    //已付款
    $("#payed_btn").click(function() {
        var customer_name = localStorage["name"];
        // console.log("---------------");
        // console.log(customer_name);
        var product_name = $('select[name="product_name"]').val();
        var unit = $('#unit').val();
        var comment = $('#comment').val();
        var data = {
            customer_name: customer_name,
            product_name: product_name,
            unit: unit,
            comment: comment,
            OpType: "payed_order_controller"
        };
        if (product_name == '') {
            alert('請輸入產品名稱')
        } else if (unit == '') {
            alert('請輸入購買數量')
        } else {
            var sure = confirm('確定新增?');
            if (sure) {
                payed_data(data);
            }
        }
    })

    async function payed_data(data) {
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
                window.location.href = "tables.php"
            };
        }).fail(function(error) {
            console.log(error);
        });
    }


</script>