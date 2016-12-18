<?php

require( './html-parser-master/vendor/autoload.php');
include_once "./mysql.php";
include_once "./common.php";
include_once "./source_url.php";

class Common {

    // public $conn = null;
    // public $source = null;

    // function __construct(){

    //     //initial mysql.php
    //     $this->conn = new Mysql;
    //     //initial source_url.php
    //     $this->source = new Url_source;
    // }

    //current not to use
    // public $url = array(
    //     'kuaidaili' => "http://www.kuaidaili.com/proxylist/1/",
    //     'proxy360'  => "http://www.proxy360.cn/Region/"
    //                     );


    /**
     * this function has some pro ..... not good as look
     */
    // function strip_all($string){

    //     return $editedText = str_replace(array("\t", "\n", " "), "", $string);
    // }
}

?>