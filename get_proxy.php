<?php

require( './html-parser-master/vendor/autoload.php');
include_once "./mysql.php";
include_once "./common.php";
include_once "./source_url.php";
include_once "./curl.php";


class Get_proxy {


    public $source = null;
    public $curl_class = null;

    /**
     * initial
     */
    function __construct(){
        //initial common.php
        $this->source = new Url_source;
        $this->curl_class = new Curl;

    }

    /**
     * destruct
     */
    function __destruct(){

    }


    /**
     * crul get html
     */
    function file_get_contents_curl($url,$proxy=null) {

        try {

            usleep(40000);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5); //timeout in seconds
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch,CURLOPT_USERAGENT,$this->curl_class->agents[array_rand($this->curl_class->agents)]);
            if($proxy != null){

                curl_setopt($ch, CURLOPT_PROXY, $proxy);
            }

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

            $data = curl_exec($ch);
            curl_close($ch);

            return $data;
        }
            catch(Exception $ex){
                echo "$ex"." ";
                return null;
            }
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

        if($sHtml == null) {
            return null;
        }

        $dom = $this->analy($sHtml);

        return $dom;

    }



    /**
     * source from
     *     http://www.kuaidaili.com/proxylist
     */

    function from_kuaidaili(){

        //1-10 pages
        for ($i=1; $i <= 3 ; $i++) {

            print $i." ";

            $url = 'http://www.kuaidaili.com/proxylist/'."$i";
            $dom = $this->get_dom($url);

            if($dom==null){
                echo "$i.XXX";
                continue;
            }


            $this->source->from_kuaidaili($dom);

        }

        echo "over********";

    }


    /**
     * source from
     *     http://www.xicidaili.com/nn/
     *
     * current not error 500 !!!!!!!!!!11
     */

    function from_xicidaili(){

        //1-10 pages
        for ($i=1; $i <= 1 ; $i++) {

            print $i." ";

            $url = 'http://www.xicidaili.com/nn/'."$i";
            $dom = $this->get_dom($url);

            if($dom==null){
                echo "$i.XXX";
                continue;
            }


            $this->source->from_xicidaili($dom);

        }

        echo "over********";



    }


    /**
     * source from
     *     http://www.proxy360.cn/default.aspx
     */

    function from_proxy360(){

        $url = 'http://www.proxy360.cn/default.aspx';
        $dom = $this->get_dom($url);

        if($dom==null){

            echo "$url.XXX";

        }else{

            $this->source->from_proxy360($dom);

        }


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





?>


