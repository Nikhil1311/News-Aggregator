<?php
extract($_GET);
$file=fopen("business_content.txt","r");
$pos = 2000*$count;
fseek($file, $pos);
$retstr = fread($file, 2000);
echo $retstr;


?>