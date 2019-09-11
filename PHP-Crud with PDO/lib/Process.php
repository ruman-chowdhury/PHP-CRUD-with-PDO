<?php  
	include 'lib/Database.php';

	class Process{
		private $db;

		public function __construct(){
			
			$this->db =  new Database();

		}

	//====================process of work========================
		//==========Select data=======
		public function selectData(){
			$query = "SELECT * FROM mobiles ORDER BY Id ASC ";

			$query = $this->db->conn->prepare($query);
			$query->execute();

			$result = $query->fetchAll(PDO::FETCH_ASSOC); //fetch all rows as array
			return $result;
		}
		

		//==========Insert data=======
		public function insertData($data){

			$brand = $data['brand'];
			$price = $data['price'];
			$email = $data['email'];

			$chk_email = $this->checkEmail($email);


			if ($brand =="" OR $price =="" OR $email ==""){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Field must not be empty!</span>" ;
				return $msg;
			}

			if (strlen($brand) < 3){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Name is too short!</span>" ;
				return $msg;
			}

			if (filter_var($email,FILTER_VALIDATE_EMAIL) === false){
				$msg = "<span class='alert alert-danger'><strong>*</strong>Invalid email!</span>" ;
				return $msg;
			}

			if ($chk_email == true){
				$msg = "<span class='alert alert-danger'><strong>*</strong>Email already exist!</span>" ;
				return $msg;
			}


			$sql = "INSERT INTO mobiles(Brand, Price, Email)
					  VALUES(:Brand, :Price, :Email)";
			$query = $this->db->conn->prepare($sql);

			$query->bindValue(':Brand', $brand);
			$query->bindValue(':Price', $price);
			$query->bindValue(':Email', $email);
			$insert_row = $query->execute();		  

	
			if ($insert_row){
				header("Location: index.php");
			}

		}
		
		//check email,it is already used or not
		public function checkEmail($email){

			$sql = "SELECT Email FROM mobiles WHERE Email = :Email ";
			$query = $this->db->conn->prepare($sql);
			
			$query->bindValue(':Email',$email);
			$query->execute();

			if ( $query->rowCount() > 0 ){
				return true;

			}else{
				return false;

			}

		}//checkEmail method
		
		

		//==========Update data=======
		public function getEmployeeById($id){
			$sql = "SELECT * FROM mobiles WHERE Id =:Id LIMIT 1";
			$query = $this->db->conn->prepare($sql);

			$query->bindValue(':Id', $id);
			$query->execute();

			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
			//fetch single data as object and result is object we are returning
		}

		public function updateData($id, $data){
			
			$brand = $data['brand'];
			$price = $data['price'];
			$email = $data['email'];


			if ($brand =="" OR $price =="" OR $email ==""){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Field must not be empty!</span>" ;
				return $msg;
			}

			if (strlen($brand) < 3){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Name is too short!</span>" ;
				return $msg;
			}

			if (filter_var($email,FILTER_VALIDATE_EMAIL) === false){
				$msg = "<span class='alert alert-danger'><strong>*</strong>Invalid email!</span>" ;
				return $msg;
			}



			$sql = "UPDATE mobiles 
					SET Brand =:Brand, Price =:Price, Email =:Email WHERE Id =:Id";
			$query = $this->db->conn->prepare($sql);

			$query->bindValue(':Id', $id);
			$query->bindValue(':Brand', $brand);
			$query->bindValue(':Price', $price);
			$query->bindValue(':Email', $email);

			$update_row = $query->execute();		  

			if ($update_row){
				$msg = "<span class='alert alert-success'><strong>*</strong>Updated Successfully!</span>" ;
				return $msg;
			}

		}
		
		
		//==========Delete data=======
		public function deleteData($id){
			
				$sql = "DELETE FROM mobiles WHERE Id =:Id LIMIT 1";
				$query = $this->db->conn->prepare($sql);

				$query->bindValue(':Id', $id);
				$query->execute();

				header('Location:index.php');


		}
		




	} //end Process class

?>