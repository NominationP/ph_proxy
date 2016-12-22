<?php

include_once "./check_proxy.php";
include_once "./log.php";


try{
    date_default_timezone_set('Asia/Shanghai');
    $date = date('m/d/Y H:i:s', time());

    $start = microtime(true);

    $check = new Check_proxy;
    $log = new Log;

    $check->check("good_proxy");
    $good_num = $check->good_count;
    $bad_num  = $check->bad_count;
    $dup_num  = $check->dup;


    $time_elapsed_secs = (microtime(true) - $start)/60;
    $string = $date . "\t" . $good_num . "\t" . $bad_num . "\t" . $dup_num . "\t" . $time_elapsed_secs ."\n";
    $log->write("./log_good.txt",$string);

    echo "$string"."\n";
}catch(Exception $e){

    echo "$e";

}

?>