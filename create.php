<?php 
	// filename: create.php, Jory Lord, cis355, 2015-02-26
// Creates new entries to the Users table.

// ----- Connect to database -----

	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$THError = null;
		$TroopError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$Level = $_POST['Level'];
		$troop = $_POST['troop'];
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter name';
			$valid = false;
		}
		
		if (empty($Level)) {
			$THError = 'Please select a town hall';
			$valid = false;
		} 
		
		if (empty($troop)) {
			$troopError = 'Please select a favorite troop';
			$valid = false;
		} 
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Users (name, Selected_TH, Selected_Troop) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name, $Level, $troop));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>

<!DOCTYPE html>
<!--Paints the create screen -->
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
		    			<h3>Create a Users</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($THError)?'error':'';?>">
                        <label class="control-label">Town Hall Level</label>
                        <div class="controls">
                            <select name="Level"> 
							<?php
							//pulls all of the town hall values
							$pdo = database::connect();
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM Town_Hall";
							foreach($pdo->query($sql) as $row)
							{
								echo "<option value=$row[0]>$row[1]</option>";	
							}
							database::disconnect();
							?>
							</select>
							
                            <?php if (!empty($THError)): ?>
                                <span class="help-inline"><?php echo $THError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

						<div class="control-group <?php echo !empty($troopError)?'error':'';?>">
                        <label class="control-label">Select your Favorite Troop</label>
                        <div class="controls">
                            <select name="troop"> 
							<?php
							//pulls all of the troop values
							$pdo = database::connect();
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM Troops";
							foreach($pdo->query($sql) as $row)
							{
								echo "<option value=$row[0]>$row[1]</option>";	
							}
							database::disconnect();
							?>
							</select>
							
                            <?php if (!empty($TroopError)): ?>
                                <span class="help-inline"><?php echo $troopError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>