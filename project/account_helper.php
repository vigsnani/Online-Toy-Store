<?php

class AccountOperations{

	var $configObject;

	function __construct($config){
		$this->configObject = $config;
	}

	function updateUserInformation(){
		$userinfo_id = trim($_POST['UserInfoId']);
		$fullname = trim($_POST['fullname']);
		$street = trim($_POST['street']);
		$zip = trim($_POST['zip']);
		$state = trim($_POST['state']);
		$city = trim($_POST['city']);
		$phone = trim($_POST['phone']);

		if(!$this->configObject->initializeConnection()){
			$this->configObject->errorHandler("Database Login Failure.");
			//header("Location:accountDetails.php");
			//exit();
			return false;
	    }

		$user_id = $this->configObject->getUserId();
	    
	    //$query = "SELECT * FROM UserInformation JOIN UserLogin  WHERE 'UserLogin.user_id' = '$user_id'";
	    //$result = mysqli_query($this->configObject->connection, $query);   
	    //if(!$result || mysqli_affected_rows($this->configObject->connection) <= 0){
		if(empty($userinfo_id)){
	        $query="INSERT INTO UserInformation(user_id, street, zip, state, city, phone) VALUES ('$user_id', '$street', '$zip', '$state', '$city', '$phone')";

	        if(!mysqli_query($this->configObject->connection, $query)){
				$this->configObject->dbErrorHandler("Error updating user information.");
				//header("Location:accountDetails.php");
				//exit();
				return false;
			}

	    }
	    else{
	        $query = "Update UserInformation Set street='$street', zip='$zip', state='$state', city='$city', phone='$phone' WHERE userinfo_id='$userinfo_id'";
	        
	        if(!mysqli_query($this->configObject->connection, $query)){
	            $this->configObject->dbErrorHandler("Error updating user information");
	            //header("Location:accountDetails.php");
				//exit();
				return false;
	        }
		}

        $query = "Update UserLogin Set fullname='$fullname' WHERE user_id='$user_id'";
        
        if(!mysqli_query($this->configObject->connection, $query)){
            $this->configObject->dbErrorHandler("Error updating user information");
            //header("Location:accountDetails.php");
			//exit();
			return false;
        }

		$this->configObject->setUserFullName($fullname);

		//header("Location:accountDetails.php");
		return true;

	}

	function getUserInformation(){

		if(!$this->configObject->initializeConnection()){
			$this->configObject->errorHandler("Database Login Failure.");
			return array("success" => false, "dataRow" => NULL);
	    }

		$user_id = $this->configObject->getUserId();
	    
	    $query = "SELECT * FROM UserInformation UI JOIN UserLogin UL ON UI.User_Id = UL.User_Id WHERE UI.User_Id = $user_id";
	    $result = mysqli_query($this->configObject->connection, $query);

	    if($result && mysqli_affected_rows($this->configObject->connection) == 1){
	        $row = mysqli_fetch_array($result);
	        //var_dump($row);
			return array("success" => true, "dataRow" => $row);
	    }
	    else
		if(!$this->configObject->initializeConnection()){
			//$this->configObject->errorHandler("Database Login Failure.");
			return array("success" => false, "dataRow" => NULL);
		}
	}

	function changeUserPassword(){
		//echo $configObject->getHashKey("kunal", "password");

		if(!$this->configObject->initializeConnection()){
				$this->configObject->errorHandler("Database Login Failure.");
				//header("Location:accountDetails.php");
				//exit();
				return false;
			}

			$old_password = $this->configObject->sqlStringSanitizer($_POST['password_old']);
			$new_password = $this->configObject->sqlStringSanitizer($_POST['password_1']);
			
			$email = $this->configObject->sqlStringSanitizer($this->configObject->getUserEmail());
			$user_id = $_SESSION["user_id"];
			
			$sqlQuery = "SELECT * FROM UserLogin WHERE user_id = '$user_id'";

			$result = mysqli_query($this->configObject->connection, $sqlQuery);

			$rows=mysqli_affected_rows($this->configObject->connection);

			if($rows > 0){
				$row = mysqli_fetch_array($result);
				$salt = $row["salt"];
				$hashValue = $this->configObject->getHashKey($salt, $old_password);

				$sqlQuery = "SELECT * FROM UserLogin WHERE user_id = '$user_id' AND password = '$hashValue'";
				// AND confirmcode = 'y'
				$result = mysqli_query($this->configObject->connection, $sqlQuery);

				$rows=mysqli_affected_rows($this->configObject->connection);

				if(!$result || $rows <= 0){
					$this->configObject->dbErrorHandler("Old password entered is incorrect.");
					//header("Location:accountDetails.php");
					//exit();
					return false;
				}
				$newHashValue = $this->configObject->generateHashKey($new_password);
				$encryptedPassword = $newHashValue['encrypted'];
				$salt = $newHashValue['salt'];

				$sqlQuery = "Update UserLogin Set password='$encryptedPassword', salt='$salt' WHERE user_id = '$user_id' AND password = '$hashValue'";

				if(!mysqli_query($this->configObject->connection, $sqlQuery)){
					$this->configObject->dbErrorHandler("Error updating user's new password.");
					return false;
				}

			}

		//header("Location:accountDetails.php");
		return true;
	}
}

?>