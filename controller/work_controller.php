<?php
include('../DB.php');

foreach ($_REQUEST as $key => $val) {
    $$key = $val;
};

$today = date('Y/m/d H:i:s');
$Year = date('Y') - 1911;
$Month = date('m');
$M = intval($Month);

function sel_work_data_controller(){
    global $conn;
    global $today;
    global $M;


    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };
    
    $total_predict = 0;
    $actual = 0;
    //取前三月之O_ID
    $sql = "SELECT * FROM `order` WHERE 1";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $len = count($result);

    for($i=0; $i<$len; $i++) {
        $strM = substr($result[$i]['start_time'],5,2);
        // print_r($strM);
        $intM = intval($strM);
        // print_r($intM);
        $O_ID = $result[$i]['O_ID'];
        if($intM < 13 && $intM > 9){
            $sql_n = "SELECT `amount` 
                    FROM `order_setting` as os
                    LEFT JOIN `product` as p ON p.P_ID = os.P_ID 
                    WHERE p.`P_name` = '$product_name' AND os.O_ID = $O_ID";
            // echo $sql_n;
            $row_n = $conn->query($sql_n);
            $result_n = $row_n->fetchAll(PDO::FETCH_ASSOC);
            $len_n = count($result_n); 
            if($len_n != 0){
                $total_predict += $result_n[0]['amount'];
            }
        }
    }
    $predict = round($total_predict/3);

    //實際需求
    for($i=0; $i<$len; $i++) {
        $strM = substr($result[$i]['start_time'],5,2);
        $intM = intval($strM);
        $O_ID = $result[$i]['O_ID'];
        if($intM == $M){
            $sql_n = "SELECT `amount` 
                    FROM `order_setting` as os
                    LEFT JOIN `product` as p ON p.P_ID = os.P_ID 
                    WHERE p.`P_name` = '$product_name' AND os.O_ID = $O_ID";
            $row_n = $conn->query($sql_n);
            $result_n = $row_n->fetchAll(PDO::FETCH_ASSOC);
            $len_n = count($result_n);
            if($len_n != 0){
                $actual += $result_n[0]['amount'];
            }
        }
    }

    //庫存
    $sql_s = "SELECT `stock` FROM `product` WHERE `P_name` = '$product_name'";
    $row_s = $conn->query($sql_s);
    $result_s = $row_s->fetchAll(PDO::FETCH_ASSOC);
    $stock = intval($result_s[0]['stock']);

    $arr = array($predict,$actual,$stock);

    echo json_encode($arr);

}

$OpType();
