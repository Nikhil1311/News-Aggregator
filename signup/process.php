<?php
$conn = new mysqli('localhost','root','','books');

	extract($_POST);
	$sql = "CREATE TABLE users (
uname VARCHAR(30) PRIMARY KEY, 
pwd VARCHAR(30) NOT NULL,
email VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    #echo "Error creating table: " . $conn->error;
}
$sql = "INSERT INTO users (uname, pwd, email)
VALUES ('$uname','$pwd', '$email')";
if($pwd!=$repwd)
{
	echo("Password did not match!");
}
else
{
if ($conn->query($sql) === TRUE) {
    header('Location: '. '../index.html');
    echo "Registration Sucessful";
} else {
    echo("Username already exists");
}
}
?>