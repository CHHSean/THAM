<?php
include('../DB.php');

foreach ($_REQUEST as $key => $val) {
    $$key = $val;
};

$today = date('Y/m/d H:i:s');
$Year = date('Y') - 1911;
$Month = date('m');
$M = intval($Month);

//活動選擇
function sel_act_name_controller()
{

    global $conn;
    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };

    $sql = "SELECT  `A_name`
            FROM `act_perform` 
            WHERE 1";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);

    // print_r($result);
}

function sel_marketing_data_controller()
{

    global $conn;
    foreach ($_REQUEST as $key => $val) {
        global $$key;
    };
    // total
    $total = 1000;
    //獲取率
    $a = 432;
    $a_per = round($a / $total * 100);
    $b = 786;
    $b_per = round($b / $total * 100);
    $c = 592;
    $c_per = round($c / $total * 100);


    //取得成本
    $sql = "SELECT * 
            FROM `act_perform` 
            WHERE `A_name` = '$activity_name'";
    $row = $conn->query($sql);
    $result = $row->fetchAll(PDO::FETCH_ASSOC);
    $cost = intval($result[0]['cost']);

    //預期目標
    $a_pre = 800000;
    $b_pre = 750000;
    $c_pre = 680000;

    //活動收益
    $a_revenue = 746981;
    $b_revenue = 880226;
    $c_revenue = 360767;


    //留存率
    $a_now = 681;
    $a_past = 961;
    $a_past2 = 1242;
    $a_nowper = round($a_now/$a_past*100);
    $a_pastper = round($a_past/$a_past2*100);
    $b_now = 996;
    $b_past = 1129;
    $b_past2 = 1568;
    $b_nowper = round($b_now/$b_past*100);
    $b_pastper = round($b_past/$b_past2*100);
    $c_now = 368;
    $c_past = 786;
    $c_past2 = 1246;
    $c_nowper = round($c_now/$c_past*100);
    $c_pastper = round($c_past/$c_past2*100);

    //流失率
    $a_nowlose = 100-$a_nowper;
    $a_pastlose = 100-$a_pastper;
    $b_nowlose = 100-$b_nowper;
    $b_pastlose = 100-$b_pastper;
    $c_nowlose = 100-$c_nowper;
    $c_pastlose = 100-$c_pastper;

    if($activity_name == "牛年春節活動"){
        $arr = array($a_per,$cost,$a_pre, $a_revenue, $a_nowper, $a_pastper, $a_nowlose, $a_pastlose);
    }else if($activity_name == "中秋節大團購"){
        $arr = array($b_per,$cost,$b_pre, $b_revenue, $b_nowper, $b_pastper, $b_nowlose, $b_pastlose);
    }else if($activity_name == "中元普渡"){
        $arr = array($c_per,$cost,$c_pre, $c_revenue, $c_nowper, $c_pastper, $c_nowlose, $c_pastlose);
    }

    echo json_encode($arr);



}

$OpType();
