<?php 
// filename: read.php, Jory Lord, cis355, 2015-02-26
// reads an entries on the Users table.

// ----- Connect to database -----
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	} else {
		//pulls all requested data and joins them for easy display
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = 'SELECT Users.ID as ID, Users.Name as Name, Users.Selected_TH as TH, Troops.Troop as troop FROM Users '.
					   'LEFT JOIN Troops on Users.Selected_Troop = Troops.ID '.
					   'Where Users.ID = ?';
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<!--Paints the read screen -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Read a User</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['Name'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Town Hall Level</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['TH'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Favorite Troop</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['troop'];?>
						    </label>
					    </div>
					  </div>
					  <br/>
					    <div class="form-actions">
						  <a class="btn btn-primary" href="index.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>