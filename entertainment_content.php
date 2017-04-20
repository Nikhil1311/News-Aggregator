<?php
extract($_GET);
$file=fopen("entertainment_content.txt","r");
$pos = 2000*$count;
fseek($file, $pos);
$retstr = fread($file, 2000);
echo $retstr;


?>