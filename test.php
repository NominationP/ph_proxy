<?php

$handle = fopen("log_good.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        // process the line read.
        // $string = str_replace(' ', '', $line);
        $string = preg_replace('/\s+/', '^', $line);
        $string =substr($string, 0,-1);
        echo $string."\n";
    }

    fclose($handle);
} else {
    // error opening the file.
}

?>