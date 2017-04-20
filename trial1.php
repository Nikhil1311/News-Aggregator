<?php 
set_time_limit(0);

//extract($_GET);
$query=$_GET["search"];
//require 'trial.php';
/*$file=fopen("query.txt","w");
$pos=0;
fseek($file,$pos);
fwrite($file,$query);
fclose($file);
// $query = "sachin tendulkar"
$command = escapeshellcmd('python crawler_TOI.py');
//system('python myscript.py myargs', $retval);
// $cmd = "python crawler.py $query"; 
$output = shell_exec($command);
$command = escapeshellcmd('python crawler_BBC.py');
$output = shell_exec($command);
// echo $output;
// $output = passthru($cmd)
*/
$filename=$query.".txt";
/*
$oldtime=filemtime($filename);

$file1=fopen($filename,"r");
$pos1=0;
while(true)
{
	$newtime=filemtime($filename);
	if($newtime>$oldtime)
	{
		$string = fread($filename,filesize($filename));
		echo $string;
		$len= strlen($string);
		$pos1+=$len;
		fseek($file, $pos1);
		$oldtime = $newtime;
	}
}
*/
$str = file_get_contents($filename);
echo($str);

?>