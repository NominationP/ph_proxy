<?php

$string = "dfdfdf"."\n"."eeeee";

echo $string."\n";

echo $editedText = str_replace(array("\t", "\n", " "),"", $string);

?>