<?php
include('../DB.php');

foreach ($_REQUEST as $key => $val) {
    $$key = $val;
};

$today = date('Y/m/d H:i:s');

//新增原料
function add_material_controller()
{
    global $conn;
    global $today;

    // $date = new DateTime();

    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };
    $sql = "SELECT * FROM `material` WHERE `M_name` = '$material_name' ";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_OBJ);
    $num = count($result);

    if ($num == 0) {
        $sql = "INSERT INTO `material`( `M_name`, `cost`,`stock`, `prepare_day`) 
                        VALUES ('$material_name',$cost,$stock,$prepare_day)";
        $row = $conn->prepare($sql);
        $row->execute();
    } else {
        $sql = "UPDATE `material` SET `M_name`='$material_name',`cost`= $cost,`prepare_day`= $prepare_day WHERE`M_name` = '$material_name'";
        $row = $conn->prepare($sql);
        $row->execute();
    }
    echo json_encode(array("data" => "", "status" => '200', "message" => "成功"));
};

//新增產品
function add_product_controller()
{
    global $conn;
    global $today;


    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };
    $sql = "SELECT * FROM `product` WHERE `P_name` = '$product_name' ";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_OBJ);
    $num = count($result);

    if ($num == 0) {
        $sql = "INSERT INTO `product`( `P_name`, `price`, `stock`, `update_time`) 
                        VALUES ('$product_name',$price,$stock,  '$today')";
        $row = $conn->prepare($sql);
        $row->execute();
    } else {
        $sql = "UPDATE `product` SET `P_name`='$product_name',`price`= $price,`stock`= $stock, `update_time` = '$today' 
                WHERE`P_name` = '$product_name'";
        $row = $conn->prepare($sql);
        $row->execute();
    }

    echo json_encode(array("data" => "", "status" => '200', "message" => "成功"));
};

//新增顧客與訂單資料
function add_customer_controller()
{
    global $conn;
    global $today;


    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };
    $sql = "SELECT * FROM `customer` WHERE `C_name` = '$customername' ";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_OBJ);
    $num = count($result);


    if ($num == 0) {
        $sql = "INSERT INTO `customer`( `C_name`, `address`, `phone`, `mail`, `individual`, `signup_date`, `gender`) 
                    VALUES ('$customername',        '',         '',     '',     '',            '$today',     '')";
        $row = $conn->prepare($sql);
        $row->execute();
    }


    $sql = "SELECT `C_ID` FROM `customer` WHERE `C_name` = '$customername' ";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $num = count($result);

    // echo "-----------";
    // print_r(gettype($result[0]['C_ID']));
    $C_ID = $result[0]['C_ID'];

    $sql_o = "SELECT * FROM `order` WHERE `C_ID` = '$C_ID' AND `status` = 0";
    $row_o = $conn->query($sql_o);
    $result_o = $row_o->fetchAll(PDO::FETCH_OBJ);
    $num_o = count($result_o);

    if ($num_o == 0) {
        $sql_io = "INSERT INTO `order`( `C_ID`, `start_time`, `end_time`, `comment`, `status`) 
                    VALUES ($C_ID,'$today' , '','',0)";
        $row_io = $conn->prepare($sql_io);
        $row_io->execute();

        $sql_so = "SELECT * FROM `order` WHERE `C_ID` = '$C_ID'";
        $row_so = $conn->query($sql_so);
        $result_so = $row_so->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode(array("data" => "", "status" => '200', "message" => "成功"));
}

//暫存
function tmp_order_controller()
{
    global $conn;
    global $today;


    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };

    $sql = "SELECT * FROM `product` WHERE `P_name` = '$product_name' ";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $P_ID = $result[0]['P_ID'];
    // print_r($result);

    $sql = "SELECT * FROM `customer` WHERE `C_name` = '$customer_name' ";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $C_ID = $result[0]['C_ID'];

    $sql = "SELECT * FROM `order` WHERE `C_ID` = '$C_ID' AND `status` = 0";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $O_ID = $result[0]['O_ID'];
    $num = count($result);

    $sql = "SELECT * FROM `order_setting` WHERE `O_ID` = $O_ID";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $num = count($result);

    //檢查是否有此訂單號碼
    // for ($i = 0; $i < $num; $i++) {
    //     $sql_o = "SELECT * FROM `order` WHERE  `status` = 0";
    //     $row_o = $conn->query($sql_o);
    //     $result_o = $row_o->fetchAll(PDO::FETCH_ASSOC);
    //     $num_o = count($result_o);
    //     $O_ID = $result_o[0]['O_ID'];
    // }

    // print_r("-------------------");
    // print_r($num_o);

    if ($num == 0) {
        $sql_op = "INSERT INTO `order_setting`( `O_ID`,`P_ID`, `amount`) 
                    VALUES ($O_ID,$P_ID,$unit)";
        $row_op = $conn->prepare($sql_op);
        $row_op->execute();
    } else {
        //檢查是否已購買相同產品
        $sql_chkop = "SELECT * FROM `order_setting` WHERE `O_ID` = '$O_ID' ";
        $row_chkop = $conn->query($sql_chkop);
        $result_chkop = $row_chkop->fetchAll(PDO::FETCH_ASSOC);
        $P_exist = $result_chkop[0]['P_ID'];

        if ($P_exist != $P_ID) {
            $sql_op = "INSERT INTO `order_setting`( `O_ID`,`P_ID`, `amount`) 
            VALUES ($O_ID,$P_ID,$unit)";
            $row_op = $conn->prepare($sql_op);
            $row_op->execute();
        } else {
            $sql_op = "UPDATE `order_setting` SET `amount`= $unit
                    WHERE `P_ID` = $P_exist";
            $row_op = $conn->prepare($sql_op);
            $row_op->execute();
        }
    }


    echo json_encode(array("data" => "", "status" => '200', "message" => "成功"));
}

//已付款
function payed_order_controller()
{
    global $conn;
    global $today;


    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };

    $sql = "SELECT * FROM `product` WHERE `P_name` = '$product_name' ";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $P_ID = $result[0]['P_ID'];
    // print_r($P_ID);

    $sql = "SELECT * FROM `customer` WHERE `C_name` = '$customer_name' ";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $C_ID = $result[0]['C_ID'];

    $sql = "SELECT * FROM `order` WHERE `C_ID` = '$C_ID' AND `status` = 0";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $O_ID = $result[0]['O_ID'];
    $num = count($result);

    $sql = "SELECT * FROM `order_setting` WHERE `O_ID` = $O_ID";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $num = count($result);

    //檢查是否有此訂單號碼
    // for ($i = 0; $i < $num; $i++) {
    //     $sql_o = "SELECT * FROM `order` WHERE  `O_ID` = $O_ID";
    //     $row_o = $conn->query($sql_o);
    //     $result_o = $row_o->fetchAll(PDO::FETCH_ASSOC);
    //     $num_o = count($result_o);
    //     $O_ID = $result_o[0]['O_ID'];
    // }

    if ($num == 0) {
        $sql_op = "INSERT INTO `order_setting`( `O_ID`,`P_ID`, `amount`) 
                    VALUES ($O_ID,$P_ID,$unit)";
        $row_op = $conn->prepare($sql_op);
        $row_op->execute();
    } else {
        //檢查是否已購買相同產品
        $sql_chkop = "SELECT * FROM `order_setting` WHERE `O_ID` = '$O_ID' ";
        $row_chkop = $conn->query($sql_chkop);
        $result_chkop = $row_chkop->fetchAll(PDO::FETCH_ASSOC);
        $P_exist = $result_chkop[0]['P_ID'];

        if ($P_exist != $P_ID) {
            $sql_op = "INSERT INTO `order_setting`( `O_ID`,`P_ID`, `amount`) 
            VALUES ($O_ID,$P_ID,$unit)";
            $row_op = $conn->prepare($sql_op);
            $row_op->execute();
        } else {
            $sql_op = "UPDATE `order_setting` SET `amount`= $unit
                    WHERE `P_ID` = $P_exist";
            $row_op = $conn->prepare($sql_op);
            $row_op->execute();
        }
    }


    $sql_po = "UPDATE `order` SET `end_time`='$today',`comment`= '$comment',`status`= 1 WHERE `O_ID` = '$O_ID'";
    $row_po = $conn->prepare($sql_po);
    $row_po->execute();


    echo json_encode(array("data" => "", "status" => '200', "message" => "成功"));
}

//新增活動
function add_activity_controller()
{
    global $conn;
    global $today;


    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };

    $sql = "SELECT * FROM `act_perform` 
            WHERE `A_name` = '$activity_name' 
            AND `start_year` = $start_year 
            AND `start_month` = $start_month
            AND `start_day` = $start_day
            AND `end_year` = $end_year
            AND `end_month` = $end_month
            AND `end_day` = $end_day";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_OBJ);
    $num = count($result);

    $sql = "SELECT * FROM `target` WHERE `T_name` = '$target'";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);

    $t_id = $result[0]['T_id'];

    if ($num == 0) {
        $sql = "INSERT INTO `act_perform`( `T_ID`, `start_year`, `start_month`, `start_day`, `end_year`, `end_month`, `end_day`, `A_name`, `cost`, `Admin_id`) 
                                VALUES ($t_id, $start_year,     $start_month,   $start_day,   $end_year,    $end_month, $end_day, '$activity_name', $cost, 1)";
        $row = $conn->prepare($sql);
        $row->execute();
    }

    echo json_encode(array("data" => "", "status" => '200', "message" => "成功"));
}

//產品選擇
function sel_product_name_controller()
{

    global $conn;
    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };

    $sql = "SELECT  `P_Name`
            FROM `product` 
            WHERE 1";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);

    // print_r($result);
}

//目標選擇
function sel_target_controller()
{

    global $conn;
    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };

    $sql = "SELECT  `T_name`
            FROM `target` 
            WHERE 1";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
}

$OpType();
