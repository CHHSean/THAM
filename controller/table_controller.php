<?php
include('../DB.php');

foreach ($_REQUEST as $key => $val) {
    $$key = $val;
};

//呈現產品
function sel_product_data_controller()
{
    global $conn;
    global $today;


    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };

    $sql = "SELECT ps.`p_id`, p.P_name, p.price, p.stock, m.`cost`*ps.`useage` as product_cost ,MAX(m.prepare_day) as prepare_day 
            FROM `product_setting` as ps 
            LEFT JOIN `material` as m ON m.`M_ID` = ps.`m_id` 
            LEFT JOIN `product` as p ON p.P_ID = ps.p_id 
            GROUP BY p_id;";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);

    $len = count($result);
    $arr = array();
    for ($i = 0; $i < $len; $i++) {
        if ($result[$i]['P_name'] != "") {
            $tmp = array(
                "name" => $result[$i]['P_name'],
                "price" => $result[$i]['price'],
                "product_cost" => $result[$i]['product_cost'],
                "stock" => $result[$i]['stock'],
                "prepare_day" => $result[$i]['prepare_day'],
            );
            array_push($arr, $tmp);
        }
    }

    echo json_encode($arr);
}

//呈現原料
function sel_material_data_controller()
{
    global $conn;
    global $today;


    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };
    $sql = "SELECT * 
            FROM `material` ";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);

    // print_r($result[0]['prepare_day']);

    $len = count($result);
    $arr = array();
    for ($i = 0; $i < $len; $i++) {
        $tmp = array(
            "name" => $result[$i]['M_name'],
            "cost" => $result[$i]['cost'],
            "stock" => $result[$i]['stock'],
            "prepare_day" => $result[$i]['prepare_day'],
        );
        array_push($arr, $tmp);
    }

    echo json_encode($arr);
}
//呈現活動
function sel_activity_data()
{
    global $conn;
    global $today;


    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };

    $sql = "SELECT `start_year`, `start_month`, `start_day`, `end_year`, `end_month`, `end_day`,`A_name`,`cost`,t.T_name 
            FROM `act_perform` as a 
            LEFT JOIN `target` as t ON t.`T_id` = a.`T_ID` 
            ORDER BY a.`start_month` ASC;";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);

    $len = count($result);
    $arr = array();
    for ($i = 0; $i < $len; $i++) {
        $tmp = array(
            "start_date" => $result[$i]['start_year'] . "-" . $result[$i]['start_month'] . "-" . $result[$i]['start_day'],
            "end_date" => $result[$i]['end_year'] . "-" . $result[$i]['end_month'] . "-" . $result[$i]['end_day'],
            "name" => $result[$i]['A_name'],
            "cost" => $result[$i]['cost'],
            "target" => $result[$i]['T_name'],
        );
        array_push($arr, $tmp);
    }
    echo json_encode($arr);
}
//呈現訂單
function sel_order_data()
{
    global $conn;
    global $today;


    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };

    $arr = array();

    $sql = "SELECT c.C_name, c.phone, c.mail,os.P_ID, os.amount, o.status
            FROM `order_setting` as os 
            LEFT JOIN `order` as o ON o.`O_ID` = os.`O_ID` 
            LEFT JOIN `customer` as c ON c.`C_ID` = o.`C_ID`;";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $len = count($result);

    $sql_p = "SELECT * FROM `product` WHERE 1;";
    $row = $conn->query($sql_p);
    $result_p = $row->fetchAll(PDO::FETCH_ASSOC);
    $len_p = count($result_p);

    for ($i = 0; $i < $len; $i++) {
        $P_os = $result[$i]['P_ID'];
        for ($p = 0; $p < $len_p; $p++) {
            $P_p = $result_p[$p]['P_ID'];
            $P_price = $result_p[$p]['price'];
            if ($P_os == $P_p) {
                $total_price = $P_price * $result[$i]['amount'];
                if ($result[$i]['status'] == 0) {
                    $tmp = array(
                        "c_name" => $result[$i]['C_name'],
                        "phone" =>  $result[$i]['phone'],
                        "mail" => $result[$i]['mail'],
                        "p_name" => $result_p[$p]['P_name'],
                        "amount" => $result[$i]['amount'],
                        "price" => $total_price,
                        "status" => "未付款",
                    );
                } else {
                    $tmp = array(
                        "c_name" => $result[$i]['C_name'],
                        "phone" =>  $result[$i]['phone'],
                        "mail" => $result[$i]['mail'],
                        "p_name" => $result_p[$p]['P_name'],
                        "amount" => $result[$i]['amount'],
                        "price" => $total_price,
                        "status" => "已付款",
                    );
                }
            }
        }
        array_push($arr, $tmp);
    }

    echo json_encode($arr);
}

$OpType();
