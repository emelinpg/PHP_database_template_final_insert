<?php 

require 'error_reporting.php';
require 'orm_functions.php';


if (isset($_POST['login']) && trim($_POST['login']) != "") {
	if(isset($_POST['username']) && isset($_POST['password']) && trim($_POST['username']) != "" && trim($_POST['password']) != "") {

		$username = escape_quotes($_POST['username']);
		$password = escape_quotes(hash("sha512", $_POST['password']));


		$user = get_all_info("SELECT * FROM Users WHERE username= '$username'");

		$userArray = $user->fetch_assoc();

		if(count($userArray) <=0) {
			die("That username doesn't exist! Try making a username today by going to <a href='loging.php'>Sign up Page</a>");
		}
		if ($userArray['password'] != $password){
			die("Incorrect pasword, please type the password again at the <a href='loging.php'>Sign up Page</a>");
	}
	

	$salt = hash("sha512", rand() . rand() . rand());

	setcookie("c_user", hash("sha512", $username), time() + 24 * 60 * 60, "/");
	setcookie("c_salt", $salt, time() + 24 * 60 * 60, "/");

	$userID = $userArray['id'];
	insert_or_update_info("UPDATE Users SET salt='$salt' WHERE id='$userID'");

	die("You are now logged in as $username.");

	echo "It Worked!";

	} else {

		echo "Please enter a username and password.";
			
	}
}


	
?>

<!doctype html>
<html>
	<head>
		<title>
			Auctions
			:: Los Angeles Modern Auctions (LAMA)
			:: The premier auction house on the West Coast to buy and sell Modern Art &amp; Design
		</title>
		<link rel="stylesheet" href="_css/styles.css">
	</head>
	<body>
		<div id="container">
			<?php include "header.php" ?>
			<div id="main" class="cf">
				<div>
					<?php

							$sql = "SELECT * FROM `items`";
							$result = get_all_info($sql);
							if ($result->num_rows > 0) {
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							        echo "<p>id: " . $row["id"]. " - Name: " . $row["itemName"]. " " . $row["itemCost"]. " " . $row["itemDesc"]. "</p>";
							    }
							} else {
							    echo "0 results";
							}
							$connect->close();

					 ?>
				</div>
				<aside>
					<h1>Login to your account!</h1>
					<form method="post" action="">
						<ul>
							<li>
								<label for="username">Username</label>
								<input id="username" type="text"name="username" value="" />
							</li>
							<li>
								<label for="password">Password</label>
								<input id="password" type="password" name="password" value="" />
							</li>
							
							<li>
								<input type="submit" name="login" value="login">
							</li>
						</ul>
					</form>
					<form method="post" action="logout.php">
					<ul>
						<li>
							<input type="submit" name="logout" value="Logout">
						</li>
					</ul>
        </form>
				</aside>
			</div>
			<?php include 'footer.php' ?>
		</div>
	</body>
</html>