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
}

$mys = new Mysql;

// $sql = "INSERT INTO good_proxy (ip,port) VALUES ('111', '2222')";
// // $mys->insert($sql);

// $sql = "SELECT ip FROM good_proxy WHERE ip=111";
// print_r ($mys->get_all("good_proxy"));
?>