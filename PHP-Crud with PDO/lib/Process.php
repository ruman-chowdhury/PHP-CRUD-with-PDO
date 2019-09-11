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

			$name = $data['name'];
			$email = $data['email'];
			$phone = $data['phone'];

			$chk_email = $this->checkEmail($email);


			if ($name =="" OR $email =="" OR $phone ==""){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Field must not be empty!</span>" ;
				return $msg;
			}

			if (strlen($name) < 3){
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


			$sql = "INSERT INTO mobiles(Name, Email, Phone)
					  VALUES(:Name, :Email, :Phone)";
			$query = $this->db->conn->prepare($sql);

			$query->bindValue(':Name', $name);
			$query->bindValue(':Email', $email);
			$query->bindValue(':Phone', $phone);
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
			$name = $data['name'];
			$email = $data['email'];
			$phone = $data['phone'];


			if ($name =="" OR $email =="" OR $phone ==""){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Field must not be empty!</span>" ;
				return $msg;
			}

			if (strlen($name) < 3){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Name is too short!</span>" ;
				return $msg;
			}

			if (filter_var($email,FILTER_VALIDATE_EMAIL) === false){
				$msg = "<span class='alert alert-danger'><strong>*</strong>Invalid email!</span>" ;
				return $msg;
			}



			$sql = "UPDATE mobiles 
					SET Name =:Name, Email =:Email, Phone =:Phone WHERE Id =:Id";
			$query = $this->db->conn->prepare($sql);

			$query->bindValue(':Id', $id);
			$query->bindValue(':Name', $name);
			$query->bindValue(':Email', $email);
			$query->bindValue(':Phone', $phone);

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