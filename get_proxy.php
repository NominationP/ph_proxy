<?php

require( './html-parser-master/vendor/autoload.php');
include_once "./mysql.php";
include_once "./common.php";
include_once "./source_url.php";


class Get_proxy {


    public $conn = null;
    public $com = null;
    public $source = null;

    /**
     * initial
     */
    function __construct(){

        //initial mysql.php
        $this->conn = new Mysql;
        //initial common.php
        $this->com = new Common;
        //initial source_url.php
        $this->source = new Url_source;

    }

    /**
     * destruct
     */
    function __destruct(){

    }


    /**
     * crul get html
     */
    function file_get_contents_curl($url) {
        $ch = curl_init();
        // $proxy = "175.8.16.170:8998";
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        // curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    /**
     * Analysis html initial
     *     by html-parser
     *     faster than simple-html-dom
     *
     *     https://github.com/bupt1987/html-parser/blob/master/README.md
     */
    function analy($sHtml){

        return $dom = new \HtmlParser\ParserDom($sHtml);
    }

    /**
     * got dom
     */
    function get_dom($url){

        $sHtml = $this->file_get_contents_curl($url);
        $dom = $this->analy($sHtml);

        return $dom;

    }



    /**
     * source from
     *     http://www.kuaidaili.com/proxylist
     */

    function from_kuaidaili(){

        //1-10 pages

        for ($i=1; $i <= 10 ; $i++) {

            // print $i."****************"."\n";

            $url = 'http://www.kuaidaili.com/proxylist/1';
            $dom = $this->get_dom($url);
            $this->source->from_kuaidaili($dom);

        }

    }


    /**
     * source from
     *     http://www.xicidaili.com/nn/
     *
     * current not error 500 !!!!!!!!!!11
     */

    function from_xicidaili(){



    }


    /**
     * source from
     *     http://www.proxy360.cn/default.aspx
     */

    function from_proxy360(){

        $url = 'http://www.proxy360.cn/default.aspx';
        $dom = $this->get_dom($url);
        $this->source->from_proxy360($dom);

    }

    /**
     * get all url to run
     * but i think is't not perfect
     * so currently not to do this work
     *
     */
    // function from_url() {

        // $url_array = $this->com->url;

        // foreach ($url_array as $key => $value) {
        //     # code...

        // }
    // }





}


$mm = new Get_proxy;

$mm->from_kuaidaili();
// print "im proxy360 ******************"."\n";
$mm->from_proxy360();



?>


