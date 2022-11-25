<?php

require "Connector.php";

function Signup() {

	$Connection = $GLOBALS['Connection'];

	// Collect User Data
	$fname = $_POST["Fname"];
	$lname = $_POST["Lname"];
	$uname = $_POST["username"];
	$passwd = md5($_POST["passwd"]);
	$email = $_POST["E-mail"];
	$birthday = $_POST["birthDay"];

	$sql = $Connection->prepare('INSERT INTO `users`
		(
		`First Name`,
		`Last Name`,
		`User Name`,
		`Password`,
		`E-Mail`,
		`BirthDay`
		)
		VALUES
		(
		?,
		?,
		?,
		?,
		?,
		?
		);
	');

	$sql->execute([$fname , $lname , $uname , $passwd , $email , $birthday]);

	header("location:/User/Login/");

}

function Login() {

	$Connection = $GLOBALS['Connection'];

	$email = $_POST["email"];
	$passwd= md5($_POST["pass"]);

	$query = $Connection->prepare("SELECT * FROM users");
	$query->execute();

	$data = $query->fetchAll();

	for ($user=0; $user < count($data); $user++) {
		
		if ($data[$user]["E-Mail"] == $email && $data[$user]["Password"] == $passwd) {
			echo "Welcome Back, " . $data[$user]['First Name'];
			exit();

		}

	}

	echo "Unknown User, ";

	echo "<a href='/'>Signup</a>";

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (isset($_POST["signup"])) {
		Signup();
	} elseif (isset($_POST["login"])) {
		Login();
	} else {
		header("location:/");
	}

} else {
	header("location:/");
}

?>