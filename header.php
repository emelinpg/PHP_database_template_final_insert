<?php 
require "sharedVar.php";

?>

<header id='masthead'>
	<h1 class='siteTitle'><?php echo $title ?></h1>
	<h2 class='tagLine'><?php echo $tagLine ?></h2>
</header>
<nav id="mainmenu">
				<a href="index.php">Home</a>
				<a href="auctions.php">Auctions</a>
				<a href="contact.php">Contact</a>
				<a href="edit_profile.php">Edit</a>
				<a href="loging.php">Login</a>
				<a href="register.php">Register</a>
				<a href="update.php">Update</a>
				<a href="delete.php">Delete</a>
				<form method="post" action="logout.php">
				<ul>
				<li>
				<input type="submit" name="logout" value="Logout">
				</li>
				</ul>
           		 </form>
			</nav>