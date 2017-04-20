<?php
	header("Content-type:text/event-stream");
	ob_start();
	$n=0;
  $oldtime = filemtime("stocks.txt");

	while(true){
    clearstatcache();//coz filemtime is cached
		$newtime = filemtime("stocks.txt");
    if($newtime != $oldtime)
    {
      $price = file_get_contents("stocks.txt");

  		echo "event:updated\n";
  		//Automatic retry occurs every 3 seconds. The line below changes it to 10 s.
  		echo "retry:10000\n";
  		//Last line must end with two \n
  		echo "data:$price\n\n";
  		ob_flush();
  		flush();
      $oldtime = $newtime;
    }
		sleep(3);


	}
?>
