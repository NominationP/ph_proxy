<?php


    class Redis{

        public $redis = null;

        public function __construct(){

            //连接本地的 Redis 服务
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);

            $this->redis = $redis;
        }


        public function get_all_key(){

            $allKeys = $this->redis->keys('*');   // all keys will match this.
            print_r($allKeys);

        }

    }


?>