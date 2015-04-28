<?php
// filename: index.php, Jory Lord, cis355, 2015-02-26
// Paints the home screen

// ----- Connect to database -----
session_start();
$user_id = $_SESSION['login_user'];
?>

<!DOCTYPE html>
<!--Paints the main screen -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
    			<h3>Clash of Clans</h3>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Create</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Name</th>
		                  <th>Town Hall</th>
		                  <th>Favorite Troop</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   //pulls all needed data and then joins them for easy display
					   $pdo = Database::connect();
					   $sql = 'SELECT Users.ID as ID, Users.Name as Name, Users.Selected_TH as TH, Troops.Troop as troop FROM Users '.
					   'LEFT JOIN Troops on Users.Selected_Troop = Troops.ID '.
					   'ORDER BY ID DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['Name'] . '</td>';
							   	echo '<td>'. $row['TH'] . '</td>';
							   	echo '<td>'. $row['troop'] . '</td>';
							   	echo '<td width=250>';
							   	echo '<a class="btn btn-primary" href="read.php?id='.$row['ID'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="update.php?id='.$row['ID'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['ID'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>