<?php 
	include 'inc/header.php'; 
	include 'lib/Process.php'; 
?>

<?php  
	$pros = new Process();

	if( ($_SERVER['REQUEST_METHOD'])=="POST" && isset($_POST['saveInfo']) ){
		
		$insert_result = $pros->insertData($_POST);
	
	}

?>


		<div class="container content_container">
				
				<div class="card">
					<div class="card-header bg-light">
						<h2>
							Add <strong>Brand</strong>
							<span class="float-right">
								<a class="btn btn-outline-dark" href="index.php">Home</a>
							</span>
						</h2>
					</div>

<?php  
	if (isset($insert_result)){
		echo $insert_result;
	}

?>					
				<div class="card-body custom_card_body">
					
					<form action="addInfo.php" method="POST" accept-charset="utf-8" class="bg-light custom_form">

						<div class="form-group">
							<label for="brand">Brand:</label>
							<input type="text" name="brand" class="form-control" id="brand">
						</div>


						<div class="form-group">
							<label for="price">Price:</label>
							<input type="number" name="price" class="form-control" id="price">
						</div>

						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" name="email" class="form-control" id="email">
						</div>
						
						

						<div class="form-group">
							<button type="submit" name="saveInfo" class="btn btn-success">Save Info</button>

							<input type="reset" class="btn btn-outline-secondary" value="Cancel">
						</div>
						

					</form>

				</div>

			</div> <!-- card -->

		</div> <!-- body contents -->


<?php include 'inc/footer.php'; ?>