<?php

include_once "./get_proxy.php";
include_once "./check_proxy.php";
include_once "./log.php";

/**
 * get proxy  and save to mysql(source_proxy) , check (source_proxy)
 */
date_default_timezone_set('Asia/Shanghai');
$date = date('m/d/Y H:i:s', time());

// echo "$date"."\n";

$start = microtime(true);
$mm = new Get_proxy;
$check = new Check_proxy;
$log = new Log;

//get source_proxy

$mm->from_kuaidaili();
print "\n"."im proxy360 ******************"."\n";
$mm->from_proxy360();
print "\n"."im xicidaili ******************"."\n";
$mm->from_xicidaili();

//check source_proxy

echo "\n"."check :"."\n";
$check->check("source_proxy");
print $check->good_count." ";
print $check->bad_count." ";
print $check->dup."\n";

$good_num = $check->good_count;
$bad_num  = $check->bad_count;
$dup_num  = $check->dup;

//check good_proxy

// $check->check("good_proxy");

// Change the line below to your timezone!

$time_elapsed_secs = (microtime(true) - $start)/60;
$string = $date . "\t" . $good_num . "\t" . $bad_num . "\t" . $dup_num . "\t" . $time_elapsed_secs ."\n";
$log->write("./log.txt",$string);

echo "$string"."\n";

/**
 * check proxy(source_proxy)  and  save good to mysql(good_proxy)
 */




?>