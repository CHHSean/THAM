<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- <meta name="description" content="" />
    <meta name="author" content="" /> -->
    <title>新增原料</title>
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
                                    <h3 class="text-center font-weight-light my-4">原料</h3>
                                </div>
                                <div class="card-body">
                                    <label for="material_name">原料名稱</label>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="material_name">
                                    </div>
                                    <label for="cost">成本</label>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="cost">
                                    </div>
                                    <label for="stock">庫存</label>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="stock">
                                    </div>
                                    <label for="prepare_day">準備天數</label>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="prepare_day">
                                    </div>
                                    <div class="form-floating mb-3">
                                        <p align="center">
                                            <button class="btn btn-primary" id="cancel_btn">取消</button>
                                            <button class="btn btn-primary" id="add_btn">新增產品</button>
                                        </p>
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
        var data = {
            material_name: $('#material_name').val(),
            cost: $('#cost').val(),
            stock: $('#stock').val(),
            prepare_day: $('#prepare_day').val(),
            OpType: "add_material_controller"
        };
        if (material_name == '') {
            alert('請輸入原料名稱')
        } else if (cost == '') {
            alert('請輸入成本')
        } else if (prepare_day = '') {
            alert('請輸入準備天數')
        } else if (stock = '') {
            alert('請輸入庫存')
        } else {
            var sure = confirm('確定新增?')
            if(sure){
                add_data(data)
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
                history.go(-1);
            };
        }).fail(function(error) {
            console.log(error);
        });
    }
</script>