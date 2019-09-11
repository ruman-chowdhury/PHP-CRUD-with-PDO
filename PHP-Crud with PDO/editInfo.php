<?php 
	include 'inc/header.php'; 
	include 'lib/Process.php'; 
?>

<?php  
	//_GET will catch id two times.1)when index to edinInfo.php 2)this page form submission
	if (isset($_GET['edit'])){
		$id = $_GET['edit'];
	}

	$pros = new Process();
	$rowById = $pros->getEmployeeById($id);

?>

<?php  
	if ( ($_SERVER['REQUEST_METHOD'] == "POST") && isset($_POST['updateInfo']) ){
		
		$updateResult = $pros->updateData($id,$_POST);

	}	
?>

	<div class="container content_container">
		
		<div class="card">
			<div class="card-header bg-light">
				<h2>
					Update <strong>Info</strong>
					<span class="float-right">
						<a class="btn btn-outline-dark" href="index.php">Home</a>
					</span>
				</h2>
			</div>

<?php  
	if (isset($updateResult)){
		echo $updateResult;
	}
?>
			
			<div class="card-body custom_card_body">
				
				<form action="editInfo.php?edit=<?php echo $id;?>" method="POST" accept-charset="utf-8" class="bg-light custom_form">

					<div class="form-group">
						<label for="brand">Brand:</label>
						<input type="text" name="brand" class="form-control" id="brand" value="<?php echo $rowById->Brand;?>">
					</div>


					<div class="form-group">
						<label for="price">Price:</label>
						<input type="number" name="price" class="form-control" id="price" value="<?php echo $rowById->Price;?>">
					</div>

					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name="email" class="form-control" id="email" value="<?php echo $rowById->Email;?>">
					</div>
					
					

					<div class="form-group">
						<button type="submit" name="updateInfo" class="btn btn-success">Update Info</button>

						<input type="reset" class="btn btn-outline-secondary" value="Cancel">
					</div>
					

				</form>

			</div>

		</div> <!-- card -->

	</div> <!-- body contents -->


<?php include 'inc/footer.php'; ?>