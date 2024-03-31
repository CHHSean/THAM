<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- <meta name="description" content="" />
        <meta name="author" content="" /> -->
    <title>新增活動</title>
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
                                    <h3 class="text-center font-weight-light my-4">活動</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-floating mb-3">
                                        <p align="center">
                                            <label for="start_year">開始年</label>
                                            <select name="start_year" id="start_year" placeholder="">
                                                <option selected="selected">2022</option>
                                            </select>
                                            <label for="start_month">開始月</label>
                                            <select name="start_month" id="start_month" placeholder="">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                            </select>
                                            <label for="start_day">開始日</label>
                                            <select name="start_day" id="start_day" placeholder="">
                                            </select>
                                        </p>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <p align="center">
                                            <label for="end_year">結束年</label>
                                            <select name="end_year" id="end_year" placeholder="">
                                                <option selected="selected">2022</option>
                                            </select>
                                            <label for="end_month">結束月</label>
                                            <select name="end_month" id="end_month" placeholder="">
                                            </select>
                                            <label for="end_day">結束日</label>
                                            <select name="end_day" id="end_day" placeholder="">
                                            </select>
                                        </p>
                                    </div>
                                    <label for="activityname">活動名稱</label>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="activityname">
                                    </div>
                                    <label for="cost">成本</label>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="cost">
                                    </div>
                                    <label for="target">目標客群</label>
                                    <div class="form-floating mb-3">
                                        <select class="form-control" id="target">
                                        </select>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <p align="center">
                                            <button class="btn btn-primary" id="cancel_btn">取消</button>
                                            <button class="btn btn-primary" id="add_btn">新增活動</button>
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
        sel_day();
        end_month();
        end_day();
        sel_target();
    })

    $('#start_month').change(function() {
        // console.log("start_month");
        $("#start_day option").remove();
        $("#end_month option").remove();
        $("#end_day option").remove();
        sel_day();
        end_month();
        end_day();
    })

    $('#start_day').change(function() {
        // console.log("start_month");
        $("#end_month option").remove();
        $("#end_day option").remove();
        // sel_day();
        end_month();
        end_day();
    })

    $('#end_month').change(function() {
        // console.log("start_month");
        // $("#end_month option").remove();
        $("#end_day option").remove();
        // end_month();
        end_day();
    })



    $("#cancel_btn").click(function() {
        var cancel = confirm('確定取消?');
        if (cancel) {
            history.go(-1);
        }
    })

    function sel_day() {
        var start_month = $("#start_month").val();
        // console.log(start_month)
        if (start_month == 1 || start_month == 3 || start_month == 5 || start_month == 7 || start_month == 8 || start_month == 10 || start_month == 12) {
            for ($i = 1; $i < 32; $i++) {
                $("#start_day").append("<option value=" + $i + ">" + $i + "</option>");
            }
        } else if (start_month == 2) {
            for ($i = 1; $i < 29; $i++) {
                $("#start_day").append("<option value=" + $i + ">" + $i + "</option>");
            }
        } else {
            for ($i = 1; $i < 31; $i++) {
                $("#start_day").append("<option value=" + $i + ">" + $i + "</option>");
            }
        }
    }

    function end_month() {
        var start_month = $("#start_month").val();
        for ($e = start_month; $e < 13; $e++) {
            $("#end_month").append("<option value=" + $e + ">" + $e + "</option>");
        }
    }

    function end_day() {
        var start_month = $("#start_month").val();
        var start_day = $("#start_day").val();

        var end_month = $("#end_month").val();

        if (end_month > start_month) {
            if (end_month == 1 || end_month == 3 || end_month == 5 || end_month == 7 || end_month == 8 || end_month == 10 || end_month == 12) {
                for ($i = 1; $i < 32; $i++) {
                    $("#end_day").append("<option value=" + $i + ">" + $i + "</option>");
                }
            } else if (end_month == 2) {
                for ($i = 1; $i < 29; $i++) {
                    $("#end_day").append("<option value=" + $i + ">" + $i + "</option>");
                }
            } else {
                for ($i = 1; $i < 31; $i++) {
                    $("#end_day").append("<option value=" + $i + ">" + $i + "</option>");
                }
            }
        } else {
            if (end_month == 1 || end_month == 3 || end_month == 5 || end_month == 7 || end_month == 8 || end_month == 10 || end_month == 12) {
                for ($i = start_day; $i < 32; $i++) {
                    $("#end_day").append("<option value=" + $i + ">" + $i + "</option>");
                }
            } else if (end_month == 2) {
                for ($i = start_day; $i < 29; $i++) {
                    $("#end_day").append("<option value=" + $i + ">" + $i + "</option>");
                }
            } else {
                for ($i = start_day; $i < 31; $i++) {
                    $("#end_day").append("<option value=" + $i + ">" + $i + "</option>");
                }
            }
        }
    }

    $("#add_btn").click(function() {
        var start_year = $("#start_year").val();
        var start_day = $("#start_day").val();
        var start_month = $("#start_month").val();
        var end_year = $("#end_year").val();
        var end_month = $("#end_month").val();
        var end_day = $("#end_day").val();
        var activity_name = $("#activityname").val();
        var cost = $("#cost").val();
        var target = $("#target").val();
        var data = {
            start_year: start_year,
            start_day: start_day,
            start_month: start_month,
            end_year: end_year,
            end_month: end_month,
            end_day: end_day,
            activity_name: activity_name,
            cost: cost,
            target: target,
            OpType: "add_activity_controller"
        };
        if (cost == '') {
            alert('請輸入成本')
        } else if (activity_name == '') {
            alert('請輸入活動名稱')
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



    async function sel_target() {
        var data = {
            OpType: 'sel_target_controller'
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
                $("#target").append("<option value=" + str[i].T_name + ">" + str[i].T_name + "</option>");
            };
        }).fail(function(error) {
            console.log(error);
        });
    };
</script>