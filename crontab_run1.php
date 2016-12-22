<?php
        #!/usr/bin/php -q
    $url='http://localhost/ph_proxy/run1.php';
    $html = file_get_contents($url);
    echo (date("Y-m-d H:i:s")."\n");
?>