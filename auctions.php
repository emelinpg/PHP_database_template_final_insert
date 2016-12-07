<?php 

require 'orm_functions.php';
require 'error_reporting.php';


if ($_POST) {

	$itemName = $_POST['itemName'];
	$itemCost = $_POST['itemCost'];
	$itemDesc = $_POST['itemDesc'];

	if ($itemName == '' || $itemCost == '' || $itemDesc == '') {
		$meow = 'Fill out all the fields';
	} else {
		insert_or_update_info("INSERT INTO items (itemName, itemCost, itemDesc) 
			VALUES ('$itemName', '$itemCost', '$itemDesc')");
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
				<div class="results">
					<?php

							$sql = "SELECT * FROM `items`";
							$result = get_all_info($sql);
							if ($result->num_rows > 0) {
							    // output data of each row
							    while($row = $result->fetch_assoc()) {
							        echo "id: " . $row["id"]. " - Name: " . $row["itemName"]. " " . $row["itemCost"]. " " . $row["itemDesc"]. "</p>";
							    }
							} else {
							    echo "0 results";
							}
							$connect->close();

					 ?>
				</div>
				<aside>
					<h1>Add some Items!</h1>
					<form method="post" action="?">
						<ul>
							<li>
								<label for="itemName">Item Name</label>
								<input type="text" name="itemName" id="itemName" placeholder="Item Name..." />
							</li>
							<li>
								<label for="itemCost">Item Cost</label>
								<input type="text" name="itemCost" id="itemCost" placeholder="Item Name" />
							<li>
								<label for="itemDesc">Item Description</label>
								<textarea type="textarea" id="itemDesc" name="itemDesc" placeholder="Item Description"></textarea>
							</li>
							<li>
								<input type="submit" value="submit">
							</li>
						</ul>
					</form>
				</aside>
			</div>
			<?php include 'footer.php' ?>
		</div>
	</body>
</html>