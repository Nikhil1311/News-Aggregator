<?php 
set_time_limit(0);
//extract($_GET);
$query=$_GET["search"];
$file=fopen("query.txt","w");
$pos=0;
// echo $query;
fseek($file,$pos);
fwrite($file,$query);
fclose($file);
// $path = ".";
// $tmp = $query.".txt"
// if ($handle = opendir($path)) {
//     while (false !== ($file = readdir($handle))) {
//         if ('.' === $file) continue;
//         if ('..' === $file) continue;

//         // do something with the file
//         if($file==$tmp)
//         {
//         	include("template.html");
//         	$filename = $query.".txt";
// 			$str = file_get_contents($filename);
// 			echo $str;
//         }
//         else
//         {
//         	include("template.html");
// 			$command = escapeshellcmd('python crawler_TOI.py');
// 			$output = shell_exec($command);
// 			$command = escapeshellcmd('python crawler_BBC.py');
// 			//system('python myscript.py myargs', $retval);
// 			// $cmd = "python crawler.py $query"; 
// 			$output = shell_exec($command);

// 			$filename = $query.".txt";
// 			$str = file_get_contents($filename);
// 			echo $str;

//         }
//     }
//     closedir($handle);
// }

// $query = "sachin tendulkar"
include("template.html");
// $command = escapeshellcmd('python crawler_TOI.py');
// $output = shell_exec($command);
$command = escapeshellcmd('python crawler.py');
//system('python myscript.py myargs', $retval);
// $cmd = "python crawler.py $query"; 
$output = shell_exec($command);

$filename = $query.".txt";
$str = file_get_contents($filename);
echo $str;


// echo $output;
// $output = passthru($cmd)
/*
$filename=$query.".txt";
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
?>