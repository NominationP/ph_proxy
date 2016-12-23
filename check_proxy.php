<?php

include_once "./mysql.php";
include_once "./get_proxy.php";

class Check_proxy {

    public $conn = null;
    public $get_proxy = null;

    public $good_count = 0;
    public $bad_count = 0;

    public $set = array();
    public $dup = 0;




    function __construct(){

        $this->conn = new Mysql;
        $this->get_proxy = new Get_proxy;
    }

    function save_mysql($ar){

        $ip = $ar['ip'];
        $port = $ar['port'];
        $sql = "INSERT INTO good_proxy (ip,port,count) VALUES ('$ip', '$port', '1')";
        $this->conn->insert($sql);

    }

    /**
     * check database--->source_proxy and save to database-->good_proxy
     *
     * @return [type] [description]
     */
    function check($table_name){

        //get proxy from database -> source_proxy

        $all_proxy = $this->conn->get_all($table_name);

        $test_url = "https://www.taobao.com/";

        $count_end = 0;

        foreach ($all_proxy as $each_proxy) {
            # code...
            // $count_end++;

            // if($count_end == 10){
            //     break;
            // }

            $t_ip = $each_proxy['ip'];
            $t_port = $each_proxy['port'];

            $test_proxy = $t_ip.":".$t_port;
            $sHtml = $this->get_proxy->file_get_contents_curl($test_url,$test_proxy);

            $id = $each_proxy['id'];
            $count = $each_proxy['count'];


            //avoid duplicate in good_proxy
            //
            if($table_name == "source_proxy"){

                //get all proxy ip from good_proxy

                // $all_good_proxy = $this->conn->get_all_proxy('good_proxy');
                $re = $this->conn->select("SELECT * FROM good_proxy WHERE ip='$t_ip' AND port='$t_port'");

                if($re != null){
                    $this->conn->delete_by_id($id,$table_name);
                    $this->dup++;
                    continue;
                }
            }

            if($sHtml == null){

                $this->bad_count++;
                print $each_proxy['id']." ";

                if($table_name == "good_proxy"){

                    //if proxy count == 0 --->delete or count--
                    if($count >= 0){

                        $this->conn->alter($table_name,$id,-1);

                    }else if($count > -5){

                        $this->conn->alter($table_name,$id,$count-1);

                    }else{

                        $this->conn->delete_by_id($id,$table_name);

                    }

                }else{

                    $this->conn->delete_by_id($id,$table_name);

                }


            }else{

                $this->good_count++;
                // echo "$test_proxy is good";

                // if in "good_proxy"
                if($table_name == "good_proxy"){

                    if($count<0){

                        $this->conn->alter($table_name,$id,0);

                    }else{

                        $this->conn->alter($table_name,$id,$count+1);

                    }

                //not in "good_proxy"
                }else{

                    $this->save_mysql($each_proxy);
                }
            }
        }
    }
}


?>