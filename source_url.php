<?php


require( './html-parser-master/vendor/autoload.php');
include_once "./mysql.php";
include_once "./common.php";
include_once "./source_url.php";

class Url_source {


    /**
     * source from
     *     http://www.kuaidaili.com/proxylist
     */

    function from_kuaidaili($dom){


        $count = 0;
        foreach ($dom->find('tr') as $line) {

            $count += 1;
            if ($count == 1){
                continue;
            }

            $ip = $line->find('td[data-title=IP]',0)->getPlainText();
            $port = $line->find('td[data-title=PORT]',0)->getPlainText();
            echo $ip.":".$port."\n";
        }
    }

        /**
         * source from
         *     http://www.xicidaili.com/nn/
         */

        function from_xicidaili($dom){


            // $count = 0;
            // foreach ($dom->find('tr') as $line) {

            //     $count += 1;
            //     if ($count == 1){
            //         continue;
            //     }

            //     $ip = $line->find('td[data-title=IP]',0)->getPlainText();
            //     $port = $line->find('td[data-title=PORT]',0)->getPlainText();
            //     echo $ip.":".$port."\n";
            // }

        }


        /**
         * source from
         *     http://www.proxy360.cn/default.aspx
         */

        function from_proxy360($dom){


            $dom = $dom->find('div#ctl00_ContentPlaceHolder1_upProjectList div[name="list_proxy_ip"]');
            // print_r($dom);
            // print_r($dom->find('div span.tbBottomLine'));
            $count = 0;
            foreach ($dom as $line) {

                $count += 1;
                if ($count == 1){
                    continue;
                }

                $ip = $line->find('span.tbBottomLine',0)->getPlainText();
                $port = $line->find('span.tbBottomLine',1)->getPlainText();

                //strip space and \n
                $ip = trim($ip);
                $port = trim($port);
                $new_proxy = $ip.":".$port;
                echo $new_proxy."\n";
            }

        }
}

?>