<?php 

$dsn = "mysql:host=localhost; dbname=signup; charset=utf8";
$user = "Signup";
$password = "";

try {
	$Connection = new PDO($dsn , $user , $password);
} catch (PDOException $error) {
	die("Error: " . $error->getMessage());
}

?>