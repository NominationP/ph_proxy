<?php

class Mysql {


    public $conn;



    /**
     * initial
     */

    function __construct(){

        // print 'construct'."\n";

        $servername = "localhost";
        $username = "root";
        $password = "#mJl&dcs.6(O";
        $dbname = "proxy";

        // Create connection
        $err_level = error_reporting(0);
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        error_reporting($err_level);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }



    /**
     * destroy
     */

    function __destruct(){

        // print 'destruct '. "\n";

        $this->conn->close();
    }



    /**
     * insert
     */

    function insert($sql){

        // print 'insert ' . "\n";
        if ($this->conn->query($sql) === TRUE) {
            // echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }



    /**
     * select
     */

    function select($sql){

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {

            $arr = array();

            while ($row = $result->fetch_assoc()){

                array_push($arr, $row);
                // print_r ($row);
            }

            return $arr;

        } else {

           return null;
        }
    }


    /**
     * get all date
     */

    function get_all($table_name){

        $sql = "SELECT * FROM ".$table_name;

        $result = $this->conn->query($sql);

        // print_r ($result->num_rows);

        if ($result->num_rows > 0) {

            $arr = array();


            while ($row = $result->fetch_assoc()){

                array_push($arr, $row);
            }

            return $arr;

        } else {

           return null;
        }
    }

    /**
     * get all date ---> format ---> proxy ip
     */

    function get_all_proxy($table_name){

            $sql = "SELECT * FROM ".$table_name;

            $result = $this->conn->query($sql);

            // print_r ($result->num_rows);

            if ($result->num_rows > 0) {


                $all_proxy = array();

                while ($row = $result->fetch_assoc()){

                    array_push($all_proxy, $row['ip'].":".$row['port']);
                }

                return $all_proxy;

            } else {

               return null;
            }
        }


    /**
     * delete by id
     * @return [type] [description]
     */
    function delete_by_id($id, $table_name){

        $sql = "DELETE FROM $table_name WHERE id=$id";
        $this->conn->query($sql);

    }

    function delete_all($table_name){

        $sql = "DELETE FROM $table_name";
        $this->conn->query($sql);
    }


    /**
     * alter
     * @return [type] [description]
     */
    function alter($table_name,$id,$count){

        $sql = "UPDATE $table_name SET `count`= $count WHERE id=$id";
        $this->conn->query($sql);

    }

    /**
     * exist
     * @param  [type] $sql [description]
     * @return [type]      [description]
     */
    function exist($sql){

        return $this->conn->query($sql);
    }

}

// $mys = new Mysql;
// $t_ip = "120.92.3.127";
// $t_port= "80";
// $re = $mys->select("SELECT * FROM good_proxy WHERE ip='$t_ip' AND port='$t_port'");
// var_dump($re);

// $re = $mys->select("SELECT * FROM `good_proxy` WHERE `ip`='60.21.209.114' AND `port`='8080'");

// print_r($re);

// $arr = $mys->get_all_proxy('source_proxy');
// $arr = array_unique($arr);

// $mys->delete_all('source_proxy');

// foreach ($arr as $key) {
//     # code...
//     $ip = explode(":", $key);
//     // print $ip[0]."\n";
//     // print $ip[1]."\n";
//     $mys->insert("INSERT INTO source_proxy(ip, port,count) VALUES ('$ip[0]','$ip[1]','0')");
//     // echo "$key"."\n";
// }


// print_r($arr);


// $mys->alter('source_proxy',20242,-1);

// $sql = "INSERT INTO good_proxy (ip,port) VALUES ('111', '2222')";
// // $mys->insert($sql);

// $sql = "SELECT ip FROM good_proxy WHERE ip=111";
// print_r ($mys->get_all("good_proxy"));
?>