<?php

include_once "./get_proxy.php";
include_once "./check_proxy.php";

/**
 * get proxy  and save to mysql(source_proxy)
 */

$mm = new Get_proxy;
// $mm->from_kuaidaili();
// print "im proxy360 ******************"."\n";
// $mm->from_proxy360();

$check = new Check_proxy;
// $check->check("source_proxy");
print $check->good_count." ";
print $check->bad_count."\n";
$check->check("good_proxy");

/**
 * check proxy(source_proxy)  and  save good to mysql(good_proxy)
 */




?>