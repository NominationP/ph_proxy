<?php

include_once "./mysql.php";

class Curl {

    public $proxy ;


    public $agents = array(
    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1',
    'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1.9) Gecko/20100508 SeaMonkey/2.0.4',
    'Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0; en-US)',
    'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; da-dk) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1'

    );


    public function get_proxy_array(){

        $conn = new Mysql;

        $proxy = $conn->get_all('good_proxy');

        $all = array();

        foreach ($proxy as $each_proxy) {
            # code...
            // $count++;

            // if($count == 10){
            //     break;
            // }

            $test_proxy = $each_proxy['ip'].":".$each_proxy['port'];

            array_push($all, $test_proxy);

        }

        print_r ($all[array_rand($all)]."\n");
        return $all[array_rand($all)];

        }

    }

?>