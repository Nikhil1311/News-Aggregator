<?php 
	require  'medoo.php';
	// Using Medoo namespace
	use Medoo\Medoo;
	 
	$database = new Medoo([
		// required
		'database_type' => 'mysql',
		'database_name' => 'books',
		'server' => 'localhost',
		'username' => 'root',
		'password' => '',
		'charset' => 'utf8'
	]);
	
	$datas = $database->select("users", [
		"uname",
		"pwd",
		"email"
	], [
		"uname" => $_POST['uname']
	]);
	if( $datas[0]['pwd'] ==  $_POST['pwd']){
		
		header('Location: '. '../index.html');
		echo "Login Sucessful";
	}else{
		header('Location: '. 'index.html');
		
	}
?>
