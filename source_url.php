<?php


require( './html-parser-master/vendor/autoload.php');


class Url_source {


    function save_mysql($ar){

        $mysql = new Mysql;
        $ip = $ar['ip'];
        $port = $ar['port'];
        $sql = "INSERT INTO source_proxy (ip,port) VALUES ('$ip', '$port')";
        $mysql->insert($sql);

    }


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
            // $proxy = $ip.":".$port."\n";
            $ar = array('ip'=>$ip , 'port'=>$port);
            $this->save_mysql($ar);

        }
    }

        /**
         * source from
         *     http://www.xicidaili.com/nn/
         */

        function from_xicidaili($dom){


            $count = 0;
            $dom = $dom->find('table#ip_list tr');


            foreach ($dom as $line) {
                $count += 1;
                if ($count == 1){
                    continue;
                }

                $ip = $line->find('td',1)->getPlainText();
                $port = $line->find('td',2)->getPlainText();
                // echo $ip.":".$port."\n";
                $ar = array('ip'=>$ip , 'port'=>$port);
                $this->save_mysql($ar);
            }

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
                // $proxy = $ip.":".$port."\n";
                $ar = array('ip'=>$ip , 'port'=>$port);
                $this->save_mysql($ar);
            }

        }
}

?>