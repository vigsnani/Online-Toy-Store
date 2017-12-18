<?php

require_once("class.phpmailer.php");

/** Default error messages*/
define("E_VAL_REQUIRED_VALUE","Please enter the value for %s");
define("E_VAL_MAXLEN_EXCEEDED","%s cannot exceed %d characters.");
define("E_VAL_UNDER_MINLEN","%s should be at least %d characters long.");
define("E_VAL_EMAIL_CHECK_FAILED","Please provide a valida email address");

class SiteConfiguration{

	var $email;
	var $password;
	var $database;
	var $connection;
	var $siteName;
	var $randomKey;

	var $error_message;
	
	function registerUser(){
		if(!isset($_POST['registerSubmit'])){
			return false;
		}

		$formData = array();
		

		/*if(!$this->doFormValidtion()){
			return false;
		}*/

		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
			$form_fields = $_POST;
		}
		else{
			$form_fields = $_GET;
		}

		$formData['fullname'] = $this->stringSanitizer($form_fields["fullname"]);
		$formData['email'] = $this->stringSanitizer($form_fields["registerEmail"]);
		$formData['password'] = $this->stringSanitizer($form_fields["registerPassword"]);

		if(!$this->saveToDatabase($formData)){
			return false;
		}
		//send confirmation email
		/*if(!$this->sendConfirmationEmail($formData)){
			return false;
		}
		*/

		//inform admin

		$this->userLogin($formData['email'], $formData['password']);
		return true;

	}


	function userLogin($email, $password){

		if(empty($email)){
			$this->errorHandler('Please enter the email.');
			return false;
		}

		if(empty($password)){
			$this->errorHandler('Please enter the password.');
			return false;
		}

		if(!isset($_SESSION)){
			session_start();
		}

		if(!$this->checkUserLoginDB($email, $password)){
			return false;
		}
		else{
			$_SESSION[$this->getLoginSessionValue()] = $email;
			$_SESSION["randomkey"] = $this->randomKey;
		}

		if(!isset($_POST['loginModalSubmit']))
			$this->goToURL("index.php");

		return true;

	}

	function logOut(){
        
        $sessionvar = $this->getLoginSessionValue();
        
        if(isset($_SESSION[$sessionvar]))
        	unset($_SESSION[$sessionvar]);

		if(isset($_SESSION["user_fullname"]))
        	unset($_SESSION["user_fullname"]);

		if(isset($_SESSION["user_email"]))
        	unset($_SESSION["user_email"]);

        if(isset($_SESSION["user_id"]))
        	unset($_SESSION["user_id"]);

        if(isset($_SESSION["user_role"]))
        	unset($_SESSION["user_role"]);

		if(isset($_SESSION["randomkey"]))
        	unset($_SESSION["randomkey"]);

        if(isset($_SESSION["user_cart_qty"]))
        	unset($_SESSION["user_cart_qty"]);

        $this->goToURL("index.php");
    }

    function isUserLoggedIn(){
    	if(isset($_SESSION[$this->getLoginSessionValue()]))
    		return true;
    	else
    		return false;
    }

    function getUserFullName(){
    	if($this->isUserLoggedIn())
    		return $_SESSION["user_fullname"];
    	else
    		return "Guest";
    }

    function setUserFullName($fullname){
    	if(isset($_SESSION["user_fullname"]))
        	$_SESSION["user_fullname"] = $fullname;
    }

    function getCartQuantity(){
    	if($this->isUserLoggedIn()){
    		$_SESSION["user_cart_qty"] = $this->getCartQuantityFromDB();

    		return $_SESSION["user_cart_qty"];
    	}
    	else
    		return "0";
    }

    function getCartQuantityFromDB(){
    	$user_id = $this->getUserId();
    	$query = "select sum(p.qty) as quantity from purchased AS p
					LEFT JOIN toy AS t ON t.toy_id = p.toy_id 
					where user_id = $user_id and p.status = 0 and t.status = 1";

		$result = $this->runSelectQuery($query);

		if($result["success"]){
            $row = mysqli_fetch_array($result["data"]);
            if(!empty($row["quantity"]))
            	return $row["quantity"];
        }

        return "0";
    }

    function setCartQuantity($qty){
    	if(isset($_SESSION["user_cart_qty"]))
        	$_SESSION["user_cart_qty"] = $qty;
    }

    function getUserEmail(){
    	if($this->isUserLoggedIn())
    		return $_SESSION["user_email"];
    	else
    		return "";
    }

    function getUserRole(){
    	if($this->isUserLoggedIn())
    		return $_SESSION["user_role"];
    	else
    		return "";
    }

    function getUserId(){
    	if($this->isUserLoggedIn())
    		return $_SESSION["user_id"];
    	else
    		return "";
    }

    function isUserAdmin(){
    	if($this->getUserRole() == "10")
    		return true;
    	else
    		return false;
    }

    function confirmUser(){
        if(empty($_GET['code'])||strlen($_GET['code'])<=10){
            $this->errorHandler("Please provide the confirm code");
            return false;
        }
        $user_rec = array();
        if(!$this->UpdateDBRecForConfirmation($user_rec)){
            return false;
        }

        //redirect to welcome page
        
        return true;
    } 


	function checkUserLoginDB($email, $password){

		if(!$this->initializeConnection()){
			$this->errorHandler("Database Login Failure.");
			return false;
		}

		$salt = $hashValue = "";

		$email = $this->sqlStringSanitizer($email);

		$sqlQuery = "SELECT * FROM UserLogin WHERE email = '" . $email . "'";

		$result = mysqli_query($this->connection, $sqlQuery);

		$rows=mysqli_affected_rows($this->connection);

		if($rows > 0){
			$row = mysqli_fetch_array($result);
			$salt = $row["salt"];
			$hashValue = $this->getHashKey($salt, $password);
		}

		$sqlQuery = "SELECT * FROM UserLogin WHERE email = '" . $email . "' AND password = '" . $hashValue . "'";
		// AND confirmcode = 'y'
		$result = mysqli_query($this->connection, $sqlQuery);

		$rows=mysqli_affected_rows($this->connection);

		if(!$result || $rows <= 0){
			$this->dbErrorHandler("Login Failed. Incorrect email or password.");
			return false;

		}

		$row = mysqli_fetch_array($result);
		//var_dump($row);
		$_SESSION["user_fullname"] = $row["Fullname"];
		$_SESSION["user_email"] = $row["Email"];
		$_SESSION["user_id"] = $row["User_Id"];
		$_SESSION["user_role"] = $row["UserRole"];
		return true;

	}

	function saveToDatabase(&$formData){

		if(!$this->initializeConnection()){
			$this->errorHandler("Database Login Failure.");
			return false;
		}

		if(!$this->checkUniqueField("email", $formData['email'])){
			$this->errorHandler("This email is already registered.");
			return false;
		}

		if(!$this->insertToDatabase($formData)){
			$this->errorHandler("Database insert operation failed.");
			return false;
		}

		return true;
	}

	function insertToDatabase(&$formData){
		$randomkey = substr(md5(uniqid()), 0, 10);
		$confirmcode = md5($formData['email'] . $randomkey . mt_rand() . mt_rand());

		$formData['confirmcode'] = $confirmcode;

		$hashKey = $this->generateHashKey($formData['password']);

		$encryptedPassword = $hashKey['encrypted'];

		$salt = $hashKey['salt'];

		$query = "INSERT INTO UserLogin (fullname, email, password, salt, confirmcode) 
		VALUES ('" . $this->sqlStringSanitizer($formData['fullname']) . "', '" . 
			$this->sqlStringSanitizer($formData['email']) . "', '" . 
			$encryptedPassword . "', '" . $salt . "', '" . $confirmcode . "')";

		if(!mysqli_query($this->connection, $query)){
			$this->dbErrorHandler("Error inserting new user data.");
			return false;
		}

		return true;

	}

	function runSelectQuery($query){
		if(!$this->initializeConnection()){
			$this->errorHandler("Database Login Failure.");
			return false;
		}

		$result = mysqli_query($this->connection, $query);

		$rows=mysqli_affected_rows($this->connection);

		if($rows >= 0){
			//$data = mysqli_fetch_array($result);
			return array("success" => true, "rows" => $rows, "data" => $result);
		}
		else{
			return array("success" => false, "rows" => -1, "data" => NULL, "error_message" => mysqli_error($this->connection));
		}
	}

	function runSQLQuery($query){
		if(!$this->initializeConnection()){
			$this->errorHandler("Database Login Failure.");
			return false;
		}

		$result = mysqli_query($this->connection, $query);

		$rows=mysqli_affected_rows($this->connection);

		if($result){
			//$data = mysqli_fetch_array($result);
			return array("success" => true, "rows" => $rows, "data" => $result);
		}
		else{
			return array("success" => false, "rows" => -1, "data" => NULL, "error_message" => mysqli_error($this->connection));
		}
	}

	function updateConfirmationInDB(&$formData){
        if(!$this->initializeConnection()){
            $this->errorHandler("Database login failed!");
            return false;
        }   
        $confirmcode = $this->SanitizeForSQL($_GET['code']);
        
        $query = "Select fullname, email from UserLogin where confirmcode='$confirmcode'";
        $result = mysqli_query($this->connection, $query);   
        if(!$result || mysqli_affected_rows($this->connection) <= 0){
            $this->errorHandler("Wrong confirm code.");
            return false;
        }
        $row = mysqli_fetch_array($result);
        $formData['fullname'] = $row['fullname'];
        $formData['email']= $row['email'];
        
        $query = "Update UserLogin Set confirmcode='y' Where confirmcode='$confirmcode'";
        
        if(!mysqli_query($this->connection, $query)){
            $this->dbErrorHandler("Error inserting data to the table\nquery:$qry");
            return false;
        }      
        return true;
    }

	function checkUniqueField($fieldName, $fieldValue){

		$fieldValue = $this->sqlStringSanitizer($fieldValue);
		$query = "SELECT user_id FROM UserLogin WHERE $fieldName = '$fieldValue'";

		$result = mysqli_query($this->connection, $query);

		if($result && mysqli_affected_rows($this->connection) > 0)
			return false;

		return true;
	}

	function generateHashKey($password){

		$salt = substr(sha1(mt_rand()), 0, 10);
		$encrypted = base64_encode(sha1($password . $salt, true) . $salt);
		$hashValue = array("salt" => $salt, "encrypted" => $encrypted);

		return $hashValue;
	}

	function getHashKey($salt, $password){

		$encrypted = base64_encode(sha1($password . $salt, true) . $salt);

		return $encrypted;
	}

	function errorHandler($errorMessage){
		$this->error_message .= $errorMessage . "\r\n";
	}

	function dbErrorHandler($errorMessage){
		$this->errorHandler($errorMessage . "\r\n mysqlerror : " . mysqli_error($this->connection));
	}

	function initializeDatabase($host, $db, $usr, $pwd, $table){
		$this->database = $db;
		$this->host = $host;
		$this->email = $usr;
		$this->passworf = $pwd;
		$this->tableName  = $table;
	}

	function initializeConnection(){

		 $this->connection = mysqli_connect($this->host, "root", "root", $this->database);

		 if(!$this->connection){
		 	$this->dbErrorHandler("Database Connection Failed. Incorrect Login Credentials.");
		 	return false;
		 }

		 if(!mysqli_select_db($this->connection, $this->database)){
		 	$this->dbErrorHandler("Connection failed for database : " . $this->database);
		 	return false;
		 }

		 /*
		 if(!mysqli_query($this->connection, "SET NAMES 'UTF8'")){
		 	$this->dbErrorHandler("Database Error : Failed to set UTF-8 Encoding.");
		 	return false;
		 }
		 */
		 return true;
	}

	function doFormValidtion(){

		$valid = true;

		if(strcmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
			$form_fields = $_POST;
		}
		else{
			$form_fields = $_GET;
		}


		$error_message = '';

		$form_fields["email"] = trim($form_fields["email"]);

		/*f(!$this->maxLengthValidation("email", $form_fields["email"], 10, $error_message)){
			$valid = false;
			$this->errorHandler($error_message);
		}

		if(!$this->minLengthValidation("email", $form_fields["email"], 5, $error_message)){
			$valid = false;
			$this->errorHandler($error_message);
		}

		if(!$this->regExpValidation("[A-Za-a0-9]", trim($form_fields["email"]), 10, $error_message)){
			$valid = false;
			$this->errorHandler("email can only contain Alpha-Numeric characters.");
		}
		*/
		if(!$this->emailValidation(trim($form_fields["email"]), $error_message)){
			$valid = false;
			$this->errorHandler($error_message);
		}

		if(!$this->maxLengthValidation("password", $form_fields["password"], 10, $error_message)){
			$valid = false;
			$this->errorHandler($error_message);
		}

		if(!$this->minLengthValidation("password", $form_fields["password"], 10, $error_message)){
			$valid = false;
			$this->errorHandler($error_message);
		}

		return $valid;

	}

	function sendConfirmationEmail(&$formvars){
        $mailer = new PHPMailer();
        
        $mailer->CharSet = 'utf-8';
        
        $mailer->AddAddress($formvars['email'],$formvars['firstname'] . $formvars['lasstname']);
        
        $mailer->Subject = "Your registration with ".$this->siteName;
        $mailer->From = "admin@thetoybox.com";
        
        $confirmcode = $formvars['confirmcode'];
        
        $confirm_url = $this->getAbsoluteURLFolder().'/confirmRegistration.php?code='.$confirmcode;
        
        $mailer->Body ="Hello ".$formvars['name']."\r\n\r\n".
        "Thanks for your registration with ".$this->siteName."\r\n".
        "Please click the link below to confirm your registration.\r\n".
        "$confirm_url\r\n".
        "\r\n".
        "Regards,\r\n".
        "Webmaster\r\n".
        $this->siteName;
        if(!$mailer->Send()){
            $this->errorHandler("Failed sending registration confirmation email.");
            return false;
        }
        return true;
    }

    function getAbsoluteURLFolder(){
        $scriptFolder = (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https://' : 'http://';
        $urldir ='';
        $pos = strrpos($_SERVER['REQUEST_URI'],'/');
        if(false !==$pos){
            $urldir = substr($_SERVER['REQUEST_URI'],0,$pos);
        }
        $scriptFolder .= $_SERVER['HTTP_HOST'].$urldir;
        return $scriptFolder;
    }

	function setWebsiteName($siteName){
		$this->siteName = $siteName;
	}

	function setRandomKey(){
		if(isset($_SESSION["randomkey"]))
        	$this->randomKey = $_SESSION["randomkey"];
        else
			$this->randomKey = substr(md5(uniqid()), 0, 10);
	}


	function getLoginSessionValue(){

        $tempValue = md5($this->randomKey);
        $sessionVariable = 'usr_' . substr($tempValue, 0, 10);
        return $sessionVariable;
    }

	function sqlStringSanitizer($sqlString){

		if(function_exists("mysql_real_escape_string")){
			return mysql_real_escape_string($sqlString);
		}
		else{
			return addslashes($sqlString);
		}
	}

	function stringSanitizer($inputString,$remove_nl=true){

        $inputString = $this->stripSlashes($inputString);
        
        if($remove_nl){
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $inputString = preg_replace($injections,'',$inputString);
        }

        return $inputString;
    } 

	function stripSlashes($inputString){

		if(get_magic_quotes_gpc()){
			$inputString = stripslashes($inputString);
		}

		return $inputString;
	}

	function requiredFieldValidation($fieldName, $value, &$error_message){

		$valid = true;

		if(!isset($value) || strlen($value) <= 0){
			$valid = false;
			$error_message = sprintf(E_VAL_REQUIRED_VALUE, $fieldName, $maxLength);
		}

		return $valid;
	}

	function maxLengthValidation($fieldName, $value, $maxLength, &$error_message){

		$valid = true;

		if(isset($value)){
			$len = strlen($value);
			if($len > $maxLength){
				$valid = false;
				$error_message = sprintf(E_VAL_MAXLEN_EXCEEDED, $fieldName, $maxLength);
			}
		}

		return $valid;
	}

	function minLengthValidation($fieldName, $value, $minLength, &$error_message){

		$valid = true;

		if(isset($value)){
			$len = strlen($value);
			if($len < $minLength){
				$valid = false;
				$error_message = sprintf(E_VAL_UNDER_MINLEN, $fieldName, $minLength);
			}
		}

		return $valid;
	}

	function emailValidation($value, &$error_message){

		$valid = true;

		 if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $value)){
		 	$valid = false;
		 	$error_message = E_VAL_EMAIL_CHECK_FAILED;
		 }

		 return $valid;
	}

	function regExpValidation($value, $regRxp){

		$valid = true;

		 if(preg_match($regRxp, $value)){
		 	$valid = false;
		 }

		 return $valid;
	}

	function getSelfScript(){
        return htmlentities($_SERVER['PHP_SELF']);
    }
    
    function goToURL($url){
        header("Location: $url");
        exit();
    }
    
    function getErrorMessage(){
        if(empty($this->error_message)){
            return '';
        }
        $errormsg = nl2br(htmlentities($this->error_message));
        return $errormsg;
    }  

}

?>