<?php

    class log{



        function write($file,$string){

            // Write the contents back to the file
            // file_put_contents($file, $string);
            file_put_contents($file, $string.PHP_EOL , FILE_APPEND | LOCK_EX);


        }
    }

?>

